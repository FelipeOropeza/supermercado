<?php

namespace App\Controllers;

use App\DTOs\Admin\CategoriaDTO;
use App\DTOs\Admin\EditCategoriaDTO;
use App\Services\CategoriaService;
use Core\Http\Response;

class AdminController
{
    private CategoriaService $categoriaService;

    public function __construct()
    {
        $this->categoriaService = new CategoriaService();
    }

    public function dashboard()
    {
        $totalCategorias = $this->categoriaService->count();
        return view('admin/dashboard', ['totalCategorias' => $totalCategorias]);
    }

    public function categorias()
    {
        $categorias = $this->categoriaService->getAll();
        return view('admin/categorias/index', ['categorias' => $categorias]);
    }

    public function categoriasCreate()
    {
        return view('admin/categorias/modals/create');
    }

    public function categoriasEdit($id)
    {
        $categoria = $this->categoriaService->getById($id);
        return view('admin/categorias/modals/edit', ['categoria' => $categoria]);
    }

    public function categoriasStore(CategoriaDTO $dto)
    {
        try {
            $this->categoriaService->create($dto);
        } catch (\Exception $e) {
            return Response::makeRedirect('/admin/categorias');
        }

        return Response::makeRedirect('/admin/categorias');
    }

    public function categoriasDestroy($id)
    {
        try {
            $this->categoriaService->delete($id);
        } catch (\Exception $e) {
            return Response::makeRedirect('/admin/categorias');
        }

        return Response::makeRedirect('/admin/categorias');
    }

    public function categoriasUpdate(EditCategoriaDTO $dto, $id)
    {
        try {
            $this->categoriaService->update($id, $dto);
        } catch (\Exception $e) {
            return Response::makeRedirect('/admin/categorias');
        }

        return Response::makeRedirect('/admin/categorias');
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
