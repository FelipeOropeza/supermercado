<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Admin\CategoriaDTO;
use App\DTOs\Admin\EditCategoriaDTO;
use App\Models\Categoria;

class CategoriaService
{
    private Categoria $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new Categoria();
    }

    public function create(CategoriaDTO $dto): int
    {
        $data = $this->normalizeDescricao($dto->toArray());

        $categoriaID = $this->categoriaModel->insert($data);

        if (!$categoriaID) {
            throw new \Exception('Erro ao criar categoria');
        }

        return $categoriaID;
    }

    public function delete(int|string $id): void
    {
        $categoria = $this->categoriaModel->find($id);

        if (!$categoria) {
            throw new \Exception('Categoria não encontrada');
        }

        $this->categoriaModel->delete($id);
    }

    public function getById(int|string $id): ?Categoria
    {
        return $this->categoriaModel->find($id);
    }

    public function getAll(): array
    {
        return $this->categoriaModel->all();
    }

    public function update(int|string $id, EditCategoriaDTO $dto): bool
    {
        $categoria = $this->categoriaModel->find($id);

        if (!$categoria) {
            throw new \Exception('Categoria não encontrada');
        }

        $data = $this->normalizeDescricao($dto->toArray());

        return $this->categoriaModel->update($id, $data);
    }

    public function count(): int
    {
        return $this->categoriaModel->count();
    }

    /**
     * Garante que a descrição tenha um valor padrão se vier vazia.
     */
    private function normalizeDescricao(array $data): array
    {
        if (empty(trim($data['descricao'] ?? ''))) {
            $data['descricao'] = 'Não foi colocado';
        }

        return $data;
    }
}
