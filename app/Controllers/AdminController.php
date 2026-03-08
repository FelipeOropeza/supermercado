<?php

declare(strict_types=1);

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
        $this->categoriaService = app(CategoriaService::class);
        $this->produtoService   = app(ProdutoService::class);
    }

    public function dashboard(): mixed
    {
        $totalCategorias = $this->categoriaService->count();
        $totalProdutos   = $this->produtoService->count();

        return view('admin/dashboard', [
            'totalCategorias' => $totalCategorias,
            'totalProdutos'   => $totalProdutos,
        ]);
    }

    public function categorias(): mixed
    {
        $categorias = $this->categoriaService->getAll();
        return view('admin/categorias/index', ['categorias' => $categorias]);
    }

    public function categoriasCreate(): mixed
    {
        return view('admin/categorias/modals/create');
    }

    public function categoriasEdit(int|string $id): mixed
    {
        $categoria = $this->categoriaService->getById($id);
        return view('admin/categorias/modals/edit', ['categoria' => $categoria]);
    }

    public function categoriasStore(CategoriaDTO $dto): Response
    {
        try {
            $this->categoriaService->create($dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao criar categoria: ' . $e->getMessage());
            return Response::makeRedirect('/admin/categorias');
        }

        session()->set('success', 'Categoria criada com sucesso!');
        return Response::makeRedirect('/admin/categorias');
    }

    public function categoriasDestroy(int|string $id): Response
    {
        try {
            $this->categoriaService->delete($id);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao excluir categoria: ' . $e->getMessage());
            return Response::makeRedirect('/admin/categorias');
        }

        session()->set('success', 'Categoria excluída com sucesso!');
        return Response::makeRedirect('/admin/categorias');
    }

    public function categoriasUpdate(EditCategoriaDTO $dto, int|string $id): Response
    {
        try {
            $this->categoriaService->update($id, $dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao atualizar categoria: ' . $e->getMessage());
            return Response::makeRedirect('/admin/categorias');
        }

        session()->set('success', 'Categoria atualizada com sucesso!');
        return Response::makeRedirect('/admin/categorias');
    }

    public function produtos(): mixed
    {
        $produtos = $this->produtoService->getAll();
        return view('admin/produtos/index', ['produtos' => $produtos]);
    }

    public function produtosCreate(): mixed
    {
        $categoriasList = $this->categoriaService->getAll();
        return view('admin/produtos/modals/create', ['categoriasList' => $categoriasList]);
    }

    public function produtosStore(ProdutoDTO $dto): Response
    {
        try {
            $this->produtoService->create($dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao criar produto: ' . $e->getMessage());
            return Response::makeRedirect('/admin/produtos');
        }

        session()->set('success', 'Produto criado com sucesso!');
        return Response::makeRedirect('/admin/produtos');
    }

    public function produtosEdit(int|string $id): mixed
    {
        $produto        = $this->produtoService->getById($id);
        $categoriasList = $this->categoriaService->getAll();

        return view('admin/produtos/modals/edit', [
            'produto'        => $produto,
            'categoriasList' => $categoriasList,
        ]);
    }

    public function produtosUpdate(ProdutoDTO $dto, int|string $id): Response
    {
        try {
            $this->produtoService->update($id, $dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao atualizar produto: ' . $e->getMessage());
            return Response::makeRedirect('/admin/produtos');
        }

        session()->set('success', 'Produto atualizado com sucesso!');
        return Response::makeRedirect('/admin/produtos');
    }

    public function produtosDestroy(int|string $id): Response
    {
        try {
            $this->produtoService->delete($id);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao excluir produto: ' . $e->getMessage());
            return Response::makeRedirect('/admin/produtos');
        }

        session()->set('success', 'Produto excluído com sucesso!');
        return Response::makeRedirect('/admin/produtos');
    }

    public function promocoes(): mixed
    {
        return view('admin/promocoes/index');
    }

    public function acessos(): mixed
    {
        return view('admin/acessos/index');
    }
}
