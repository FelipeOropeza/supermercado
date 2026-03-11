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
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $categorias = $this->categoriaService->getAll();
            return view('admin/categorias/index', ['categorias' => $categorias]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível listar as categorias');
            return Response::makeRedirect('/admin/categorias');
        }
    }

    public function categoriasCreate(): mixed
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            return view('admin/categorias/modals/create');
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar a categoria');
            return Response::makeRedirect('/admin/categorias');
        }
    }

    public function categoriasEdit(int|string $id): mixed
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $categoria = $this->categoriaService->getById($id);
            return view('admin/categorias/modals/edit', ['categoria' => $categoria]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível editar a categoria');
            return Response::makeRedirect('/admin/categorias');
        }
    }

    public function categoriasStore(CategoriaDTO $dto): Response
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $this->categoriaService->create($dto);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar a categoria');
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
            fail_validation('error', 'Não foi possível excluir a categoria');
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
            fail_validation('error', 'Não foi possível atualizar a categoria');
            return Response::makeRedirect('/admin/categorias');
        }

        session()->set('success', 'Categoria atualizada com sucesso!');
        return Response::makeRedirect('/admin/categorias');
    }

    public function produtos(): mixed
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $produtos = $this->produtoService->getAll();
            $categoriasList = $this->categoriaService->getAll();
            
            return view('admin/produtos/index', [
                'produtos'       => $produtos,
                'categoriasList' => $categoriasList,
            ]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível listar os produtos');
            return Response::makeRedirect('/admin/produtos');
        }
    }

    public function produtosCreate(): mixed
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $categoriasList = $this->categoriaService->getAll();
            return view('admin/produtos/modals/create', ['categoriasList' => $categoriasList]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar o produto');
            return Response::makeRedirect('/admin/produtos');
        }
    }

    public function produtosStore(ProdutoDTO $dto): Response
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $this->produtoService->create($dto);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar o produto');
            return Response::makeRedirect('/admin/produtos');
        }

        session()->set('success', 'Produto criado com sucesso!');
        return Response::makeRedirect('/admin/produtos');
    }

    public function produtosEdit(int|string $id): mixed
    {
        $this->checkRole(['admin', 'gerente', 'funcionario']);
        try {
            $produto        = $this->produtoService->getById($id);
            $categoriasList = $this->categoriaService->getAll();
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível editar o produto');
            return Response::makeRedirect('/admin/produtos');
        }

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
            fail_validation('error', 'Não foi possível atualizar o produto');
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
            fail_validation('error', 'Não foi possível excluir o produto');
            return Response::makeRedirect('/admin/produtos');
        }

        session()->set('success', 'Produto excluído com sucesso!');
        return Response::makeRedirect('/admin/produtos');
    }

    public function promocoes(): mixed
    {
        $this->checkRole(['admin', 'gerente']);
        try {
            $promocoes = $this->promocaoService->getAll();
            $produtosList = $this->produtoService->getAll();
            
            return view('admin/promocoes/index', [
                'promocoes' => $promocoes,
                'produtosList' => $produtosList
            ]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível listar as promoções');
            return Response::makeRedirect('/admin/promocoes');
        }
    }

    public function promocoesStore(PromocaoDTO $dto): Response
    {
        $this->checkRole(['admin', 'gerente']);
        try {
            $this->promocaoService->create($dto);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar a promoção');
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
            fail_validation('error', 'Não foi possível excluir a promoção');
            return Response::makeRedirect('/admin/promocoes');
        }

        session()->set('success', 'Promoção excluída com sucesso!');
        return Response::makeRedirect('/admin/promocoes');
    }

    public function acessos(): mixed
    {
        $this->checkRole(['admin']);
        try {
            $acessos = $this->acessoService->getAll();
            return view('admin/acessos/index', ['acessos' => $acessos]);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível listar os acessos');
            return Response::makeRedirect('/admin/acessos');
        }
    }

    public function acessosCreate(): mixed
    {
        $this->checkRole(['admin']);
        try {
            return view('admin/acessos/modals/create');
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar o acesso');
            return Response::makeRedirect('/admin/acessos');
        }
    }

    public function acessosStore(AcessoDTO $dto): Response
    {
        $this->checkRole(['admin']);
        try {
            $this->acessoService->create($dto);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível criar o acesso');
            return Response::makeRedirect('/admin/acessos');
        }

        session()->set('success', 'Acesso criado com sucesso!');
        return Response::makeRedirect('/admin/acessos');
    }

    public function acessosEdit(int|string $id): mixed
    {
        $this->checkRole(['admin']);
        try {
            $acesso = $this->acessoService->getById($id);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível editar o acesso');
            return Response::makeRedirect('/admin/acessos');
        }
        return view('admin/acessos/modals/edit', ['acesso' => $acesso]);
    }

    public function acessosUpdate(EditAcessoDTO $dto, int|string $id): Response
    {
        $this->checkRole(['admin']);
        try {
            $this->acessoService->update($id, $dto);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível atualizar o acesso');
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
            fail_validation('error', 'O sistema não permite excluir o usuário raiz.');
            return Response::makeRedirect('/admin/acessos');
        }

        try {
            $this->acessoService->delete($id);
        } catch (\Exception $e) {
            fail_validation('error', 'Não foi possível excluir o acesso');
            return Response::makeRedirect('/admin/acessos');
        }

        session()->set('success', 'Acesso excluído com sucesso!');
        return Response::makeRedirect('/admin/acessos');
    }
}
