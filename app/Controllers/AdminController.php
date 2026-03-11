<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DTOs\Admin\CategoriaDTO;
use App\DTOs\Admin\EditCategoriaDTO;
use App\DTOs\Admin\EditProdutoDTO;
use App\DTOs\Admin\ProdutoDTO;
use App\DTOs\Admin\PromocaoDTO;
use App\DTOs\Admin\AcessoDTO;
use App\DTOs\Admin\EditAcessoDTO;
use App\Services\CategoriaService;
use App\Services\ProdutoService;
use App\Services\PromocaoService;
use App\Services\AcessoService;
use Core\Http\Response;

class AdminController
{
    private CategoriaService $categoriaService;
    private ProdutoService $produtoService;
    private PromocaoService $promocaoService;
    private AcessoService $acessoService;

    private function checkRole(array $allowedRoles): void
    {
        $role = session('user')['role'] ?? 'cliente';
        if (!in_array($role, $allowedRoles)) {
            session()->set('error', 'Você não tem permissão para realizar esta ação.');
            header('Location: /admin');
            exit;
        }
    }

    public function __construct()
    {
        $this->categoriaService = app(CategoriaService::class);
        $this->produtoService   = app(ProdutoService::class);
        $this->promocaoService  = app(PromocaoService::class);
        $this->acessoService    = app(AcessoService::class);
    }

    public function dashboard(): mixed
    {
        $totalCategorias = $this->categoriaService->count();
        $totalProdutos   = $this->produtoService->count();
        $totalPromocoes  = $this->promocaoService->count();

        return view('admin/dashboard', [
            'totalCategorias' => $totalCategorias,
            'totalProdutos'   => $totalProdutos,
            'totalPromocoes'  => $totalPromocoes,
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
        $this->checkRole(['admin', 'gerente', 'funcionario']);
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
        $this->checkRole(['admin']);
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
        $this->checkRole(['admin', 'gerente']);
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
        $categoriasList = $this->categoriaService->getAll();

        return view('admin/produtos/index', [
            'produtos'       => $produtos,
            'categoriasList' => $categoriasList,
        ]);
    }

    public function produtosCreate(): mixed
    {
        $categoriasList = $this->categoriaService->getAll();
        return view('admin/produtos/modals/create', ['categoriasList' => $categoriasList]);
    }

    public function produtosStore(ProdutoDTO $dto): Response
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
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

    public function produtosUpdate(EditProdutoDTO $dto, int|string $id): Response
    {
        $this->checkRole(['admin', 'gerente']);
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
        $this->checkRole(['admin']);
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
        $promocoes = $this->promocaoService->getAll();
        $produtosList = $this->produtoService->getAll();
        
        return view('admin/promocoes/index', [
            'promocoes' => $promocoes,
            'produtosList' => $produtosList
        ]);
    }

    public function promocoesStore(PromocaoDTO $dto): Response
    {
        $this->checkRole(['admin', 'gerente']);
        try {
            $this->promocaoService->create($dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao criar promoção: ' . $e->getMessage());
            return Response::makeRedirect('/admin/promocoes');
        }

        session()->set('success', 'Promoção criada com sucesso!');
        return Response::makeRedirect('/admin/promocoes');
    }

    public function promocoesDestroy(int|string $id): Response
    {
        $this->checkRole(['admin']);
        try {
            $this->promocaoService->delete($id);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao excluir promoção: ' . $e->getMessage());
            return Response::makeRedirect('/admin/promocoes');
        }

        session()->set('success', 'Promoção excluída com sucesso!');
        return Response::makeRedirect('/admin/promocoes');
    }

    public function acessos(): mixed
    {
        $this->checkRole(['admin']);
        $acessos = $this->acessoService->getAll();
        return view('admin/acessos/index', ['acessos' => $acessos]);
    }

    public function acessosCreate(): mixed
    {
        $this->checkRole(['admin']);
        return view('admin/acessos/modals/create');
    }

    public function acessosStore(AcessoDTO $dto): Response
    {
        $this->checkRole(['admin']);
        try {
            $this->acessoService->create($dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao criar acesso: ' . $e->getMessage());
            return Response::makeRedirect('/admin/acessos');
        }

        session()->set('success', 'Acesso criado com sucesso!');
        return Response::makeRedirect('/admin/acessos');
    }

    public function acessosEdit(int|string $id): mixed
    {
        $this->checkRole(['admin']);
        $acesso = $this->acessoService->getById($id);
        return view('admin/acessos/modals/edit', ['acesso' => $acesso]);
    }

    public function acessosUpdate(EditAcessoDTO $dto, int|string $id): Response
    {
        $this->checkRole(['admin']);
        try {
            $this->acessoService->update($id, $dto);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao atualizar acesso: ' . $e->getMessage());
            return Response::makeRedirect('/admin/acessos');
        }

        session()->set('success', 'Acesso atualizado com sucesso!');
        return Response::makeRedirect('/admin/acessos');
    }

    public function acessosDestroy(int|string $id): Response
    {
        $this->checkRole(['admin']);
        
        // Bloqueia exclusão do usuário root (ID 1)
        if ($id == 1) {
            session()->set('error', 'O sistema não permite excluir o usuário raiz.');
            return Response::makeRedirect('/admin/acessos');
        }

        try {
            $this->acessoService->delete($id);
        } catch (\Exception $e) {
            session()->set('error', 'Erro ao excluir acesso: ' . $e->getMessage());
            return Response::makeRedirect('/admin/acessos');
        }

        session()->set('success', 'Acesso excluído com sucesso!');
        return Response::makeRedirect('/admin/acessos');
    }
}
