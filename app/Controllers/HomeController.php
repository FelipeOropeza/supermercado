<?php

namespace App\Controllers;

use Core\Http\Controller;
use Core\Attributes\Route\Get;

class HomeController extends Controller
{
    #[Get('/')]
    public function index()
    {
        // No futuro, aqui buscaremos as promoções e categorias do banco de dados.
        $data = [
            'title' => 'Início | Supermercado'
        ];

        return view('home', $data);
    }
}
