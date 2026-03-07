<?php

namespace App\Controllers;

use Core\Http\Response;

class AdminController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function categorias()
    {
        return view('admin/categorias/index');
    }

    public function produtos()
    {
        return view('admin/produtos/index');
    }

    public function promocoes()
    {
        return view('admin/promocoes/index');
    }

    public function acessos()
    {
        return view('admin/acessos/index');
    }
}
