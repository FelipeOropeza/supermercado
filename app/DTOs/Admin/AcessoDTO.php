<?php

namespace App\DTOs\Admin;

use Core\Validation\DataTransferObject;
use Core\Attributes\Required;
use Core\Attributes\Email;
use Core\Attributes\Unique;
use Core\Attributes\Min;
use Core\Attributes\Hash;
use Core\Attributes\MatchField;

class AcessoDTO extends DataTransferObject
{
   #[Required(message: 'O nome é obrigatório.')]
    public string $nome;

    #[Required(message: 'O e-mail é obrigatório.')]
    #[Email(message: 'Forneça um e-mail válido.')]
    #[Unique(table: 'usuarios', column: 'email', message: 'Este e-mail já está em uso.', ignore: 'id')]
    public string $email;

    #[Required(message: 'A senha é obrigatória.')]
    #[Min(8, message: 'A senha deve ter no mínimo 8 caracteres.')]
    #[Hash]
    public string $senha;

    #[Required(message: 'O CPF é obrigatório.')]
    #[Min(11, message: 'O CPF deve ter no mínimo 11 caracteres.')]
    #[Unique(table: 'usuarios', column: 'cpf', message: 'Este CPF já está em uso.', ignore: 'id')]
    public string $cpf;

    #[Required(message: 'O telefone é obrigatório.')]
    #[Min(11, message: 'O telefone deve ter no mínimo 11 caracteres.')]
    public string $telefone;

    #[Required(message: 'O perfil é obrigatório.')]
    public string $role;
}
