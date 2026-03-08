<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Endereco;
use App\DTOs\Usuario\EnderecoDTO;

class EnderecoService
{
    private Endereco $model;

    public function __construct()
    {
        $this->model = new Endereco();
    }

    /**
     * Lista todos os endereços de um usuário.
     */
    public function listByUsuario(int $usuarioId): array
    {
        return $this->model->where('usuario_id', '=', $usuarioId)->get();
    }

    /**
     * Busca um endereço pelo ID e Usuario.
     */
    public function find(int $id, int $usuarioId): ?Endereco
    {
        return $this->model->where('id', '=', $id)
            ->where('usuario_id', '=', $usuarioId)
            ->first();
    }

    /**
     * Cria um novo endereço para o usuário.
     */
    public function create(EnderecoDTO $dto): int
    {
        return $this->model->insert($dto->toArray());
    }

    /**
     * Atualiza um endereço existente.
     */
    public function update(int $id, EnderecoDTO $dto): bool
    {
        return $this->model->update($id, $dto->toArray());
    }

    /**
     * Deleta um endereço garantindo que ele pertença ao usuário.
     */
    public function delete(int $id, int $usuarioId): bool
    {
        return $this->model
            ->where('id', '=', $id)
            ->where('usuario_id', '=', $usuarioId)
            ->delete();
    }
}
