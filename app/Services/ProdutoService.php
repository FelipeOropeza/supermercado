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

        if ($dto->ativo == true) {
            $data['ativo'] = 1;
        } else {
            $data['ativo'] = 0;
        }

        return $this->produtoModel->insert($data);
    }

    public function getAll(): array
    {
        return $this->produtoModel->all();
    }

    public function getAllWithTrashed(): array
    {
        return $this->produtoModel->withTrashed()->get();
    }

    public function getAtivos(): array
    {
        return $this->produtoModel->where('ativo', '=', 1)->get();
    }

    public function getById(int|string $id, bool $withTrashed = false): ?Produto
    {
        if ($withTrashed) {
            return $this->produtoModel->withTrashed()->where('id', '=', $id)->first();
        }
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

        if ($dto->ativo == true) {
            $data['ativo'] = 1;
        } else {
            $data['ativo'] = 0;
        }

        return $this->produtoModel->update($id, $data);
    }

    public function delete(int|string $id): bool
    {
        return $this->produtoModel->delete($id);
    }

    public function restore(int|string $id): bool
    {
        $sql = "UPDATE produtos SET deleted_at = NULL WHERE id = :id";
        $stmt = \Core\Database\Connection::getInstance()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        return $this->produtoModel->count();
    }

    public function getByCategoria(int|string $id, ?int $limit = null): array
    {
        $query = $this->produtoModel
            ->where('categoria_id', '=', $id)
            ->where('ativo', '=', 1);

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Busca produtos por termo, categoria e ordenação
     */
    public function search(?string $term = null, ?int $categoria_id = null, ?string $orderBy = null): array
    {
        $query = $this->produtoModel->where('ativo', '=', 1);

        if ($term) {
            $query->where('nome', 'LIKE', "%{$term}%");
        }

        if ($categoria_id) {
            $query->where('categoria_id', '=', $categoria_id);
        }

        if ($orderBy) {
            switch ($orderBy) {
                case 'preco_min':
                    $query->orderBy('preco', 'ASC');
                    break;
                case 'preco_max':
                    $query->orderBy('preco', 'DESC');
                    break;
                case 'nome':
                    $query->orderBy('nome', 'ASC');
                    break;
                case 'mais_recentes':
                default:
                    $query->orderBy('created_at', 'DESC');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        return $query->get();
    }
}
