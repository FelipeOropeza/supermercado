<?php

declare(strict_types=1);

namespace App\DTOs\Admin;

use Core\Attributes\Image;
use Core\Attributes\IsInt;
use Core\Attributes\IsFloat;
use Core\Attributes\IsBool;
use Core\Attributes\Min;
use Core\Attributes\Max;
use Core\Validation\DataTransferObject;
use Core\Attributes\Required;

/**
 * DTO para atualização de produto.
 * Diferente do ProdutoDTO (criação), a imagem é OPCIONAL:
 * o usuário pode editar os dados sem precisar re-enviar a imagem.
 */
class EditProdutoDTO extends DataTransferObject
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

    // Imagem OPCIONAL no update — só atualiza se o usuário enviar um novo arquivo
    #[Image(maxSizeMB: 5, mimes: ['image/jpeg', 'image/png'], message: 'Arquivo de imagem inválido.')]
    public mixed $imagem_url = null;

    #[Required(message: 'Campo obrigatório.')]
    #[IsBool(message: 'Campo inválido.')]
    public bool $ativo;
}
