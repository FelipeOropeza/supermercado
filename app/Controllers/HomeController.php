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
    public function index()
    {
        // Se for uma requisição do HTMX pedindo apenas a lista
        if (request()->header('HX-Request')) {
            return $this->renderPromocoesGrid();
        }

        $today = date('Y-m-d H:i:s');

        // Busca promoções ativas com destaque folheto = 1 (com Eager Loading de produto)
        $promocoes = (new Promocao())
            ->with('produto')
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->where('destaque_folheto', '=', '1')
            ->get();

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
        
        $produtoIds = [];
        foreach ($categorias as $categoria) {
            $categoria->produtos = $this->produtoService->getByCategoria($categoria->id, 5);
            foreach ($categoria->produtos as $produto) {
                $produtoIds[] = $produto->id;
            }
        }

        if (!empty($produtoIds)) {
            $promocoesAtivas = (new Promocao())
                ->whereIn('produto_id', $produtoIds)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->get();
                
            $mapaPromocoes = [];
            foreach ($promocoesAtivas as $promo) {
                $mapaPromocoes[$promo->produto_id] = $promo->preco_promocional;
            }
            
            foreach ($categorias as $categoria) {
                foreach ($categoria->produtos as $produto) {
                    if (isset($mapaPromocoes[$produto->id])) {
                        $produto->preco_promocional = $mapaPromocoes[$produto->id];
                    }
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
            ->with('produto')
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->where('destaque_folheto', '=', '1')
            ->get();

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
        
        $order = request()->get('order');
        // Busca paginada por categoria (12 por página)
        $paginated = $this->produtoService->search(null, $id, $order, 12);
        $produtos = $paginated['data'];

        // Verifica se há promoções ativas para estes produtos numa só query
        $today = date('Y-m-d H:i:s');
        $produtoIds = array_map(fn($p) => $p->id, $produtos);
        if (!empty($produtoIds)) {
            $promocoesAtivas = (new Promocao())
                ->whereIn('produto_id', $produtoIds)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->get();
                
            $mapaPromo = [];
            foreach ($promocoesAtivas as $promo) {
                $mapaPromo[$promo->produto_id] = $promo->preco_promocional;
            }
            
            foreach ($produtos as $produto) {
                if (isset($mapaPromo[$produto->id])) {
                    $produto->preco_promocional = $mapaPromo[$produto->id];
                }
            }
        }

        // Se for requisição HTMX para atualizar apenas o grid (filtros ou paginação)
        if (request()->header('HX-Request')) {
            return view('components/produtos_grid', [
                'produtos'  => $produtos,
                'paginacao' => $paginated
            ]);
        }

        return view('produtos/categoria', [
            'categoria'  => $categoria,
            'categorias' => $categorias,
            'produtos'   => $produtos,
            'paginacao'  => $paginated
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

        // Busca paginada (12 por página)
        $paginated = $this->produtoService->search($term, $categoria_id, $order, 12);
        $produtos = $paginated['data'];
        $categorias = $this->categoriaService->getAll();

        $today = date('Y-m-d H:i:s');
        $produtoIds = array_map(fn($p) => $p->id, $produtos);
        if (!empty($produtoIds)) {
            $promocoesAtivas = (new Promocao())
                ->whereIn('produto_id', $produtoIds)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->get();
                
            $mapaPromo = [];
            foreach ($promocoesAtivas as $promo) {
                $mapaPromo[$promo->produto_id] = $promo->preco_promocional;
            }
            
            foreach ($produtos as $produto) {
                if (isset($mapaPromo[$produto->id])) {
                    $produto->preco_promocional = $mapaPromo[$produto->id];
                }
            }
        }

        if (request()->header('HX-Request')) {
            return view('components/produtos_grid', [
                'produtos'  => $produtos,
                'paginacao' => $paginated // Passa pra exibir controles dentro do grid se necessário
            ]);
        }

        return view('produtos/busca', [
            'title'                => 'Busca: ' . ($term ?: 'Todos os produtos'),
            'produtos'             => $produtos,
            'paginacao'            => $paginated,
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

        // Preço promocional para sugestões num só tiro
        $sugestaoIds = array_map(fn($s) => $s->id, $sugestoes);
        if (!empty($sugestaoIds)) {
            $promocoesAtivas = (new Promocao())
                ->whereIn('produto_id', $sugestaoIds)
                ->where('data_inicio', '<=', $today)
                ->where('data_fim', '>=', $today)
                ->get();
                
            $mapaPromo = [];
            foreach ($promocoesAtivas as $promo) {
                $mapaPromo[$promo->produto_id] = $promo->preco_promocional;
            }
            
            foreach ($sugestoes as $sugestao) {
                if (isset($mapaPromo[$sugestao->id])) {
                    $sugestao->preco_promocional = $mapaPromo[$sugestao->id];
                }
            }
        }

        return view('produtos/visualizar', [
            'title'     => $produto->nome . ' | Supermercado',
            'produto'   => $produto,
            'sugestoes' => $sugestoes
        ]);
    }
}
