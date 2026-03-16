<?php

namespace App\DTOs\Auth;

use Core\Validation\DataTransferObject;
use Core\Attributes\Required;
use Core\Attributes\Email;
use Core\Attributes\Hash;
use Core\Attributes\MatchField;
use Core\Attributes\Min;
use Core\Attributes\Unique;
use Core\Attributes\Trim;

class RegisterDTO extends DataTransferObject
{
    #[Required(message: 'O nome é obrigatório.')]
    #[Trim]
    public string $nome;

    #[Required(message: 'O e-mail é obrigatório.')]
    #[Email(message: 'Forneça um e-mail válido.')]
    #[Trim]
    #[Unique(table: 'usuarios', column: 'email', message: 'Este e-mail já está em uso.', ignore: 'id')]
    public string $email;

    #[Required(message: 'A senha é obrigatória.')]
    #[Min(8, message: 'A senha deve ter no mínimo 8 caracteres.')]
    #[Hash]
    public string $senha;

    #[Required(message: 'A confirmação de senha é obrigatória.')]
    #[MatchField(fieldToMatch: 'senha', message: 'As senhas não coincidem.')]
    #[Trim]
    public string $senha_confirmacao;

    #[Min(11, message: 'O CPF deve ter no mínimo 11 caracteres.')]
    #[Trim]
    public ?string $cpf = null;

    #[Min(11, message: 'O telefone deve ter no mínimo 11 caracteres.')]
    public ?string $telefone = null;
}
