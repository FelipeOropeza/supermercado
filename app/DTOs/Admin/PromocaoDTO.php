<?php

namespace App\DTOs\Admin;

use Core\Attributes\IsInt;
use Core\Attributes\IsFloat;
use Core\Attributes\IsBool;
use Core\Validation\DataTransferObject;
use Core\Attributes\Required;
use App\Mutators\NormalizaDatetime;

class PromocaoDTO extends DataTransferObject
{
    #[Required(message: 'Campo obrigatório.')]
    #[IsInt(message: 'Deve ser um número inteiro.')]
    public int $produto_id;

    #[Required(message: 'Campo obrigatório.')]
    #[IsFloat(precision: 10, scale: 2, message: 'Deve ser um número.')]
    public float $preco_promocional;

    #[Required(message: 'Campo obrigatório.')]
    #[NormalizaDatetime]
    public string $data_inicio;

    #[Required(message: 'Campo obrigatório.')]
    #[NormalizaDatetime]
    public string $data_fim;

    #[IsBool(message: 'Deve ser um valor booleano.')]
    public bool $destaque_folheto = false;
}
