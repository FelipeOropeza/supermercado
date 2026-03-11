<?php

namespace App\DTOs\Admin;

use Core\Attributes\File;
use Core\Attributes\Image;
use Core\Attributes\IsBool;
use Core\Attributes\IsInt;
use Core\Attributes\IsFloat;
use Core\Attributes\Min;
use Core\Attributes\Max;
use Core\Validation\DataTransferObject;
use Core\Attributes\Required;

class ProdutoDTO extends DataTransferObject
{
    #[Required(message: 'Campo obrigatório.')]
    #[Min(3, message: 'Mínimo de 3 caracteres.')]
    #[Max(100, message: 'Máximo de 100 caracteres.')]
    public string $nome;

    #[Required(message: 'Campo obrigatório.')]
    #[IsInt(message: 'Campo inválido.')]
    public int $categoria_id;

    #[Required(message: 'Campo obrigatório.')]
    #[Min(0, message: 'O preço deve ser maior ou igual a 0.')]
    #[IsFloat(message: 'Campo inválido.')]
    public float $preco;

    #[Required(message: 'Campo obrigatório.')]
    #[Min(0, message: 'O estoque deve ser maior ou igual a 0.')]
    #[IsInt(message: 'Campo inválido.')]
    public int $estoque;

    #[Required(message: 'Campo obrigatório.')]
    #[Min(3, message: 'Mínimo de 3 caracteres.')]
    #[Max(100, message: 'Máximo de 100 caracteres.')]
    public string $descricao;

    #[Image(maxSizeMB: 5, mimes: ['image/jpeg', 'image/png'], message: 'Arquivo de imagem inválido.')]
    #[Required(message: 'Campo obrigatório.')]
    public mixed $imagem_url;

    #[Required(message: 'Campo obrigatório.')]
    #[IsBool(message: 'Campo inválido.')]
    public bool $ativo;
}
