<?php

namespace App\Services;

use App\Models\Usuario;
use App\DTOs\Admin\AcessoDTO;
use App\DTOs\Admin\EditAcessoDTO;

class AcessoService
{
    private Usuario $usuario;
    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function getAll(): array
    {
        return $this->usuario
            ->whereIn('role', ['admin', 'gerente', 'funcionario'])
            ->get();
    }

    public function create(AcessoDTO $dto): void
    {
        $this->usuario->insert($dto->toArray());
    }

    public function getById(int|string $id): ?object
    {
        return $this->usuario->find($id);
    }

    public function update(int|string $id, EditAcessoDTO $dto): void
    {
        $data = $dto->toArray();
        if (empty($data['senha'])) {
            unset($data['senha']);
        }
        $this->usuario->update($id, $data);
    }

    public function delete(int|string $id): void
    {
        $this->usuario->delete($id);
    }
}
