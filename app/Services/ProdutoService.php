<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Produto;
use App\DTOs\Admin\ProdutoDTO;
use App\DTOs\Admin\EditProdutoDTO;

class ProdutoService
{
    private Produto $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    public function create(ProdutoDTO $dto): int
    {
        $data = $dto->toArray();

        if ($dto->imagem_url instanceof \Core\Http\UploadedFile) {
            $data['imagem_url'] = $dto->imagem_url->store('produtos', 'local');
        }

        return $this->produtoModel->insert($data);
    }

    public function getAll(): array
    {
        return $this->produtoModel->all();
    }

    public function getById(int|string $id): ?Produto
    {
        return $this->produtoModel->find($id);
    }

    /** @param int|string $id @param EditProdutoDTO $dto */
    public function update(int|string $id, EditProdutoDTO $dto): bool
    {
        $data = $dto->toArray();

        if (isset($data['imagem_url']) && $dto->imagem_url instanceof \Core\Http\UploadedFile) {
            $data['imagem_url'] = $dto->imagem_url->store('produtos', 'local');
        } else {
            // Mantém a imagem existente — não sobrescreve com null
            unset($data['imagem_url']);
        }

        return $this->produtoModel->update($id, $data);
    }

    public function delete(int|string $id): bool
    {
        return $this->produtoModel->delete($id);
    }

    public function count(): int
    {
        return $this->produtoModel->count();
    }
}
