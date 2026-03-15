<?php

namespace App\Controllers;

use App\Services\CarrinhoService;
use Core\Http\Response;
use Core\Http\Controller;

class CarrinhoController extends Controller
{
    private CarrinhoService $carrinhoService;

    public function __construct()
    {
        $this->carrinhoService = app(CarrinhoService::class);
    }

    /**
     * Adiciona um item ao carrinho
     */
    public function add(int $id)
    {
        if (!session()->has('user')) {
             return (new Response())->hxRedirect('/login');
        }

        $usuarioId = session('user')['id'];
        $quantidade = request()->get('quantidade', 1);

        $this->carrinhoService->addItem($usuarioId, $id, (int)$quantidade);

        if (request()->header('HX-Request')) {
            return (new Response())->hxTrigger('cart-updated');
        }

        return Response::makeRedirect('/');
    }

    /**
     * Retorna apenas o contador do carrinho (badge)
     */
    public function count()
    {
        $usuarioId = session('user')['id'] ?? 0;
        $cartCount = $usuarioId ? $this->carrinhoService->getCartCount($usuarioId) : 0;
        
        return view('carrinho/partials/cart_badge', ['cartCount' => $cartCount]);
    }

    /**
     * Exibe o carrinho
     */
    public function index()
    {
        if (!session()->has('user')) {
             return Response::makeRedirect('/login');
        }

        $usuarioId = session('user')['id'];
        $itens = $this->carrinhoService->getCartItems($usuarioId);

        return view('carrinho/index', [
            'title' => 'Meu Carrinho | Supermercado',
            'itens' => $itens
        ]);
    }

    /**
     * Atualiza a quantidade de um item
     */
    public function update(int $id)
    {
        if (!session()->has('user')) {
             return Response::makeJson(['error' => 'Unauthorized'], 401);       
        }

        $usuarioId = session('user')['id'];
        $quantidade = request()->get('quantidade');

        $this->carrinhoService->updateItem($usuarioId, $id, (int)$quantidade);

        if (request()->header('HX-Request')) {
            return $this->renderCartPartial($usuarioId);
        }

        return Response::makeRedirect('/carrinho');
    }

    /**
     * Remove um item do carrinho
     */
    public function remove(int $id)
    {
        if (!session()->has('user')) {
             return Response::makeJson(['error' => 'Unauthorized'], 401);
        }

        $usuarioId = session('user')['id'];
        $this->carrinhoService->removeItem($usuarioId, $id);

        if (request()->header('HX-Request')) {
            return $this->renderCartPartial($usuarioId);
        }

        return Response::makeRedirect('/carrinho');
    }

    /**
     * Renderiza o partial do carrinho (para atualizações HTMX)
     */
    private function renderCartPartial(int $usuarioId)
    {
        $itens = $this->carrinhoService->getCartItems($usuarioId);
        $html = view('carrinho/partials/cart_table', ['itens' => $itens]);
        
        return (new Response($html))->hxTrigger('cart-updated');
    }
}
