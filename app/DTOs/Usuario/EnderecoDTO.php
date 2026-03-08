<?php

namespace App\DTOs\Usuario;

use Core\Validation\DataTransferObject;
use Core\Attributes\Required;
use Core\Attributes\Min;
use Core\Attributes\Unique;

class EnderecoDTO extends DataTransferObject
{
    public ?int $id = null;
    public int $usuario_id;

    #[Required(message: 'O CEP é obrigatório.')]
    #[Min(8, message: 'O CEP deve ter pelo menos 8 caracteres.')]
    #[Unique(table: 'enderecos', column: 'cep', message: 'CEP já cadastrado.', ignore: 'id')]
    public string $cep;

    #[Required(message: 'A rua é obrigatória.')]
    public string $rua;

    #[Required(message: 'O número é obrigatório.')]
    public string $numero;

    public ?string $complemento = null;

    #[Required(message: 'O bairro é obrigatório.')]
    public string $bairro;

    #[Required(message: 'A cidade é obrigatória.')]
    public string $cidade;

    #[Required(message: 'O estado é obrigatório.')]
    #[Min(2, message: 'O estado deve ter 2 caracteres.')]
    public string $estado;
}
