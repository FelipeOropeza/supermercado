<?php

namespace App\Controllers;

use Core\Http\Controller;
use Core\Http\Response;
use App\Services\EnderecoService;
use App\DTOs\Usuario\EnderecoDTO;

class UsuarioController extends Controller
{
    private EnderecoService $enderecoService;
    private \App\Services\PedidoService $pedidoService;

    public function __construct()
    {
        $this->enderecoService = new EnderecoService();
        $this->pedidoService = app(\App\Services\PedidoService::class);
    }

    /**
     * Tela inicial de Minha Conta (lista endereços e dados do usuário)
     */
    public function profile()
    {
        $usuarioId = session('user')['id'];
        $enderecos = $this->enderecoService->listByUsuario($usuarioId);

        return view('account/index', [
            'enderecos' => $enderecos,
            'tab' => 'enderecos'
        ]);
    }

    /**
     * Lista os pedidos do usuário
     */
    public function pedidos()
    {
        $usuarioId = session('user')['id'];
        $pedidos = $this->pedidoService->getPedidosUsuario($usuarioId);

        return view('account/index', [
            'pedidos' => $pedidos,
            'tab' => 'pedidos'
        ]);
    }

    /**
     * Exibe os detalhes de um pedido específico
     */
    public function visualizarPedido(int $id)
    {
        $usuarioId = session('user')['id'];
        $pedido = $this->pedidoService->getPedidoWithItens($id, $usuarioId);

        if (!$pedido) {
            session()->set('error', 'Pedido não encontrado.');
            return Response::makeRedirect('/minha-conta/pedidos');
        }

        return view('account/pedidos/view', [
            'pedido' => $pedido
        ]);
    }

    /**
     * Formulário para cadastrar novo endereço
     */
    public function createEndereco()
    {
        return view('account/enderecos/create');
    }

    /**
     * Processa a criação do endereço via DTO e Service
     */
    public function storeEndereco()
    {
        // Ao instanciar o DTO, a validação ocorre automaticamente.
        // Se falhar, o Handler global redireciona de volta com os erros.
        $data = request()->all();
        $data['usuario_id'] = session('user')['id'];

        $dto = new EnderecoDTO($data);

        $this->enderecoService->create($dto);

        session()->set('success', 'Endereço adicionado com sucesso!');
        return Response::makeRedirect('/minha-conta');
    }

    /**
     * Tela de edição de endereço
     */
    public function editEndereco(int $id)
    {
        $usuarioId = session('user')['id'];
        $endereco = $this->enderecoService->find($id, $usuarioId);

        if (!$endereco) {
            session()->set('error', 'Endereço não encontrado.');
            return Response::makeRedirect('/minha-conta');
        }

        return view('account/enderecos/edit', ['endereco' => $endereco]);
    }

    /**
     * Processa a atualização do endereço
     */
    public function updateEndereco(int $id)
    {
        $usuarioId = session('user')['id'];

        $data = request()->all();
        $data['id'] = $id; // Crucial para o UniqueCepRule ignorar este ID
        $data['usuario_id'] = $usuarioId;

        $dto = new EnderecoDTO($data);

        $this->enderecoService->update($id, $dto);

        session()->set('success', 'Endereço atualizado com sucesso!');
        return Response::makeRedirect('/minha-conta');
    }

    /**
     * Processa a exclusão do endereço
     */
    public function deleteEndereco(int $id)
    {
        $usuarioId = session('user')['id'];
        $this->enderecoService->delete($id, $usuarioId);

        session()->set('success', 'Endereço excluído com sucesso!');
        return Response::makeRedirect('/minha-conta');
    }
}
