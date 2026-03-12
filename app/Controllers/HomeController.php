<?php

namespace App\Controllers;

use Core\Http\Controller;
use Core\Attributes\Route\Get;

class HomeController extends Controller
{
    #[Get('/')]
    public function index()
    {
        // Se for uma requisição do HTMX pedindo apenas a lista
        if (request()->header('HX-Request')) {
            return $this->renderPromocoesGrid();
        }

        $today = date('Y-m-d H:i:s');

        // Busca promoções ativas com destaque folheto = 1
        $promocoes = (new \App\Models\Promocao())
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
     * Renderiza apenas o grid de promoções (usado pelo HTMX)
     */
    public function renderPromocoesGrid()
    {
        $today = date('Y-m-d H:i:s');
        $promocoes = (new \App\Models\Promocao())
            ->where('data_inicio', '<=', $today)
            ->where('data_fim', '>=', $today)
            ->where('destaque_folheto', '=', '1')
            ->get();

        foreach ($promocoes as $promocao) {
            $promocao->produto = $promocao->produto();
        }

        return view('components/promocoes_grid', ['promocoes' => $promocoes]);
    }
}
