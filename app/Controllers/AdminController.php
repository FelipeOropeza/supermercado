<?php

namespace App\Controllers;

use App\DTOs\Admin\CategoriaDTO;
use App\DTOs\Admin\EditCategoriaDTO;
use App\DTOs\Admin\ProdutoDTO;
use App\Services\CategoriaService;
use App\Services\ProdutoService;
use Core\Http\Response;

class AdminController
{
    private CategoriaService $categoriaService;
    private ProdutoService $produtoService;

    public function __construct()
    {
        $this->categoriaService = new CategoriaService();
        $this->produtoService = new ProdutoService();
    }

    public function dashboard()
    {
        $totalCategorias = $this->categoriaService->count();
        $totalProdutos = $this->produtoService->count();
        return view('admin/dashboard', ['totalCategorias' => $totalCategorias, 'totalProdutos' => $totalProdutos]);
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
        $produtos = $this->produtoService->getAll();
        return view('admin/produtos/index', ['produtos' => $produtos]);
    }

    public function produtosCreate()
    {
        $categoriasList = $this->categoriaService->getAll();
        return view('admin/produtos/modals/create', ['categoriasList' => $categoriasList]);
    }

    public function produtosStore(ProdutoDTO $dto)
    {
        try {
            $this->produtoService->create($dto);
        } catch (\Exception $e) {
            return Response::makeRedirect('/admin/produtos');
        }

        return Response::makeRedirect('/admin/produtos');
    }

    public function produtosEdit($id)
    {
        $produto = $this->produtoService->getById($id);
        $categoriasList = $this->categoriaService->getAll();
        
        return view('admin/produtos/modals/edit', [
            'produto' => $produto,
            'categoriasList' => $categoriasList
        ]);
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
