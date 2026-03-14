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

    public function delete(int|string $id): array
    {
        $categoria = $this->categoriaModel->find($id);

        if (!$categoria) {
            throw new \Exception('Categoria não encontrada');
        }

        // Busca IDs dos produtos que serão afetados
        $db = \Core\Database\Connection::getInstance();
        $stmtIds = $db->prepare("SELECT id FROM produtos WHERE categoria_id = ? AND deleted_at IS NULL");
        $stmtIds->execute([$id]);
        $productIds = $stmtIds->fetchAll(\PDO::FETCH_COLUMN);

        // Soft delete na categoria
        $this->categoriaModel->delete($id);

        // Cascata: Soft delete nos produtos desta categoria
        $stmt = $db->prepare("UPDATE produtos SET deleted_at = NOW() WHERE categoria_id = ? AND deleted_at IS NULL");
        $stmt->execute([$id]);

        return $productIds;
    }

    public function restore(int|string $id): array
    {
        $db = \Core\Database\Connection::getInstance();
        
        // Busca IDs dos produtos que serão afetados (restaurados)
        $stmtIds = $db->prepare("SELECT id FROM produtos WHERE categoria_id = ? AND deleted_at IS NOT NULL");
        $stmtIds->execute([$id]);
        $productIds = $stmtIds->fetchAll(\PDO::FETCH_COLUMN);

        // Restaura a categoria
        $stmt = $db->prepare("UPDATE categorias SET deleted_at = NULL WHERE id = ?");
        $stmt->execute([$id]);

        // Cascata: Restaura os produtos desta categoria
        $stmtProducts = $db->prepare("UPDATE produtos SET deleted_at = NULL WHERE categoria_id = ?");
        $stmtProducts->execute([$id]);

        return $productIds;
    }

    public function getById(int|string $id, bool $withTrashed = false): ?Categoria
    {
        if ($withTrashed) {
            return $this->categoriaModel->withTrashed()->where('id', '=', $id)->first();
        }
        return $this->categoriaModel->find($id);
    }

    public function getAll(bool $withTrashed = false): array
    {
        if ($withTrashed) {
            return $this->categoriaModel->withTrashed()->get();
        }
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
