<?php

namespace App\DTOs\Admin;

use Core\Attributes\Required;
use Core\Attributes\Min;
use Core\Attributes\Max;
use Core\Validation\DataTransferObject;

class CategoriaDTO extends DataTransferObject
{
    #[Required(message: 'O nome da categoria é obrigatório.')]
    #[Min(3, message: 'O nome deve ter pelo menos 3 caracteres.')]
    #[Max(50, message: 'O nome deve ter no máximo 50 caracteres.')]
    public string $nome;

    public ?string $descricao;
}