<?php

namespace App\Controllers;

use App\Services\CarrinhoService;
use App\Services\PedidoService;
use App\Models\Endereco;
use Core\Http\Response;
use Core\Http\Controller;

class CheckoutController extends Controller
{
    private CarrinhoService $carrinhoService;
    private PedidoService $pedidoService;

    public function __construct()
    {
        $this->carrinhoService = app(CarrinhoService::class);
        $this->pedidoService = app(PedidoService::class);
    }

    /**
     * Exibe a tela de finalização de pedido
     */
    public function index()
    {
        if (!session()->has('user')) {
            return Response::makeRedirect('/login');
        }

        $usuarioId = session('user')['id'];
        $itens = $this->carrinhoService->getCartItems($usuarioId);

        if (empty($itens)) {
            return Response::makeRedirect('/carrinho');
        }

        $enderecos = (new Endereco())->where('usuario_id', '=', $usuarioId)->get();

        return view('checkout/index', [
            'title' => 'Finalizar Compra | Supermercado',
            'itens' => $itens,
            'enderecos' => $enderecos
        ]);
    }

    /**
     * Processa o fechamento do pedido
     */
    public function store()
    {
        if (!session()->has('user')) {
            return Response::makeRedirect('/login');
        }

        $usuarioId = session('user')['id'];
        $dados = request()->all();

        // Validação básica manual (poderia usar DTO)
        if (empty($dados['endereco_id'])) {
            return Response::makeRedirectBack()->setStatusCode(422); // Idealmente com erro na sessão
        }

        try {
            $pedidoId = $this->pedidoService->criarPedido($usuarioId, $dados);
            return Response::makeRedirect('/checkout/sucesso/' . $pedidoId);
        } catch (\Exception $e) {
            // Em caso de erro, volta com mensagem
            return Response::makeRedirectBack();
        }
    }

    /**
     * Tela de sucesso após o pedido
     */
    public function sucesso(int $id)
    {
        return view('checkout/sucesso', [
            'title' => 'Pedido Realizado com Sucesso!',
            'pedidoId' => $id
        ]);
    }
}
