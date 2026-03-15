<?php

namespace App\Controllers;

use Core\Http\Controller;
use Core\Http\Response;
use Core\Attributes\Route\Get;
use App\Services\CategoriaService;
use App\Services\ProdutoService;
use App\Models\Promocao;
use Core\Attributes\Route\Middleware;

class HomeController extends Controller
{
    private CategoriaService $categoriaService;
    private ProdutoService $produtoService;

    public function __construct()
    {
        $this->categoriaService = app(CategoriaService::class);
        $this->produtoService   = app(ProdutoService::class);
    }

    #[Get('/')]
    #[Middleware('auth')]
    public function index()
    {
        // Se for uma requisição do HTMX pedindo apenas a lista
        if (request()->header('HX-Request')) {
            return $this->renderPromocoesGrid();
        }

        $today = date('Y-m-d H:i:s');

        // Busca promoções ativas com destaque folheto = 1
        $promocoes = (new Promocao())
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->where('destaque_folheto', '=', '1')
            ->get();

        // Faz o eager loading do produto para cada promoção
        foreach ($promocoes as $promocao) {
            $promocao->produto = $promocao->produto();
        }

        $data = [
            'title' => 'Início | Supermercado',
            'promocoes' => $promocoes
        ];

        return view('home', $data);
    }

    /**
     * Lista todos os produtos agrupados por categoria
     */
    #[Get('/produtos')]
    #[Middleware('auth')]
    public function produtos()
    {
        $today = date('Y-m-d H:i:s');
        $categorias = $this->categoriaService->getAll();
        
        foreach ($categorias as $categoria) {
            // Buscamos apenas 5 produtos para servir como preview de cada categoria
            $categoria->produtos = $this->produtoService->getByCategoria($categoria->id, 5);
            
            foreach ($categoria->produtos as $produto) {
                $promocaoAtiva = (new Promocao())
                    ->where('produto_id', '=', $produto->id)
                    ->where('data_inicio', '<=', $today)
                    ->where('data_fim', '>=', $today)
                    ->first();
                
                if ($promocaoAtiva) {
                    $produto->preco_promocional = $promocaoAtiva->preco_promocional;
                }
            }
        }

        return view('produtos/index', [
            'title' => 'Nossos Produtos | Supermercado',
            'categorias' => $categorias
        ]);
    }

    /**
     * Renderiza apenas o grid de promoções (usado pelo HTMX)
     */
    public function renderPromocoesGrid()
    {
        $today = date('Y-m-d H:i:s');
        $promocoes = (new Promocao())
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->where('destaque_folheto', '=', '1')
            ->get();

        foreach ($promocoes as $promocao) {
            $promocao->produto = $promocao->produto();
        }

        return view('components/promocoes_grid', ['promocoes' => $promocoes]);
    }

    /**
     * Lista produtos por categoria
     */
    #[Get('/categoria/{id}')]
    #[Middleware('auth')]
    public function categoria(int $id)
    {
        $categoria = $this->categoriaService->getById($id);

        if (!$categoria) {
            return Response::makeRedirect('/');
        }

        $categorias = $this->categoriaService->getAll();
        
        // Aplica filtros se houver
        $order = request()->get('order');
        $produtos = $this->produtoService->search(null, $id, $order);

        // Verifica se há promoções ativas para estes produtos
        $today = date('Y-m-d H:i:s');
        foreach ($produtos as $produto) {
            $promocaoAtiva = (new Promocao())
                ->where('produto_id', '=', $produto->id)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->first();
            
            if ($promocaoAtiva) {
                $produto->preco_promocional = $promocaoAtiva->preco_promocional;
            }
        }

        // Se for requisição HTMX para atualizar apenas o grid (filtros)
        if (request()->header('HX-Request')) {
            return view('components/produtos_grid', ['produtos' => $produtos]);
        }

        return view('produtos/categoria', [
            'categoria'  => $categoria,
            'categorias' => $categorias,
            'produtos'   => $produtos
        ]);
    }

    /**
     * Busca global de produtos
     */
    #[Get('/busca')]
    #[Middleware('auth')]
    public function busca()
    {
        $term = request()->get('q', '');
        $categoria_id = request()->get('categoria') ? (int)request()->get('categoria') : null;
        $order = request()->get('order');

        $produtos = $this->produtoService->search($term, $categoria_id, $order);
        $categorias = $this->categoriaService->getAll();

        $today = date('Y-m-d H:i:s');
        foreach ($produtos as $produto) {
            $promocaoAtiva = (new Promocao())
                ->where('produto_id', '=', $produto->id)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->first();
            
            if ($promocaoAtiva) {
                $produto->preco_promocional = $promocaoAtiva->preco_promocional;
            }
        }

        if (request()->header('HX-Request')) {
            return view('components/produtos_grid', ['produtos' => $produtos]);
        }

        return view('produtos/busca', [
            'title'                => 'Busca: ' . ($term ?: 'Todos os produtos'),
            'produtos'             => $produtos,
            'categorias'           => $categorias,
            'term'                 => $term,
            'categoriaSelecionada' => $categoria_id
        ]);
    }

    /**
     * Exibe detalhes de um produto específico
     */
    #[Get('/produto/{id}')]
    #[Middleware('auth')]
    public function visualizar(int $id)
    {
        $produto = $this->produtoService->getById($id);

        if (!$produto || $produto->ativo == 0) {
            return Response::makeRedirect('/');
        }

        $produto->categoria = $produto->categoria();
        
        // Verifica se há promoção ativa
        $today = date('Y-m-d H:i:s');
        $promocaoAtiva = (new Promocao())
            ->where('produto_id', '=', $produto->id)
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->first();
        
        if ($promocaoAtiva) {
            $produto->preco_promocional = $promocaoAtiva->preco_promocional;
            $produto->porcentagem_desconto = round((($produto->preco - $produto->preco_promocional) / $produto->preco) * 100);
        }

        // Sugestões: produtos da mesma categoria
        $sugestoes = $this->produtoService->getByCategoria($produto->categoria_id, 5);
        // Remove o produto atual das sugestões
        $sugestoes = array_filter($sugestoes, fn($p) => $p->id !== $produto->id);

        // Preço promocional para sugestões
        foreach ($sugestoes as $sugestao) {
            $promo = (new Promocao())
                ->where('produto_id', '=', $sugestao->id)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->first();
            
            if ($promo) {
                $sugestao->preco_promocional = $promo->preco_promocional;
            }
        }

        return view('produtos/visualizar', [
            'title'     => $produto->nome . ' | Supermercado',
            'produto'   => $produto,
            'sugestoes' => $sugestoes
        ]);
    }
}
