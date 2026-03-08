<?php

namespace App\Services;

use App\Models\Usuario;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;

class AuthService
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function login(LoginDTO $dto): object
    {
        $usuario = $this->usuarioModel->where('email', '=', $dto->email)->first();

        if (!$usuario || !password_verify($dto->senha, $usuario->senha)) {
            fail_validation(['email' => 'As credenciais informadas são inválidas.']);
        }

        return $usuario;
    }

    public function registrar(RegisterDTO $dto): object
    {
        $data = $dto->toArray();
        unset($data['senha_confirmacao']);

        $data['cpf'] = !empty($data['cpf']) ? $data['cpf'] : null;
        $data['telefone'] = !empty($data['telefone']) ? $data['telefone'] : null;

        $id = $this->usuarioModel->insert($data);

        return (object)[
            'id' => $id,
            'nome' => $dto->nome,
            'email' => $dto->email
        ];
    }
}
