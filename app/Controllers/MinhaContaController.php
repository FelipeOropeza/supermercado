<?php

namespace App\Controllers;

use Core\Http\Controller;
use Core\Http\Response;
use App\Models\Endereco;

class MinhaContaController extends Controller
{
    /**
     * Tela inicial de Minha Conta (lista endereços e dados do usuário)
     */
    public function index()
    {
        $usuarioId = session('user')['id'];

        // Busca os endereços do usuário
        $enderecoModel = new Endereco();
        $enderecos = $enderecoModel->where('usuario_id', '=', $usuarioId)->get();

        return view('account/index', [
            'enderecos' => $enderecos
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
     * Processa a criação do endereço
     */
    public function storeEndereco()
    {
        // Pega inputs brutos
        $data = request()->all();
        $usuarioId = session('user')['id'];

        // Como o DTO ainda não é totalmente imutavel neste MVC se usarmos direto a controller
        // vou validar via ruleset basico ou se usarmos um EnderecoDTO (vamos criar depois se quiser)
        if (empty($data['cep']) || empty($data['rua']) || empty($data['numero']) || empty($data['bairro']) || empty($data['cidade']) || empty($data['estado'])) {
            session()->set('error', 'Preencha todos os campos obrigatórios.');
            return Response::makeRedirect('/minha-conta/enderecos/novo');
        }

        $enderecoData = [
            'usuario_id' => $usuarioId,
            'cep' => $data['cep'],
            'rua' => $data['rua'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'] ?? null,
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado']
        ];

        $enderecoModel = new Endereco();
        $enderecoModel->insert($enderecoData);

        session()->set('success', 'Endereço adicionado com sucesso!');
        return Response::makeRedirect('/minha-conta');
    }
}
