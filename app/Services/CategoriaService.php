<?php

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

    public function create(CategoriaDTO $dto)
    {
        $data = $dto->toArray();

        if (empty(trim($data['descricao'] ?? ''))) {
            $data['descricao'] = 'Não foi colocado';
        }

        $categoriaID = $this->categoriaModel->insert($data);

        if (!$categoriaID) {
            throw new \Exception('Erro ao criar categoria');
        }

        return $categoriaID;
    }

    public function delete($id)
    {
        $categoria = $this->categoriaModel->find($id);

        if (!$categoria) {
            throw new \Exception('Categoria não encontrada');
        }

        $this->categoriaModel->delete($id);
    }

    public function getById($id)
    {
        return $this->categoriaModel->find($id);
    }

    public function getAll()
    {
        return $this->categoriaModel->all();
    }

    public function update($id, EditCategoriaDTO $dto)
    {
        $categoria = $this->categoriaModel->find($id);

        if (!$categoria) {
            throw new \Exception('Categoria não encontrada');
        }

        $data = $dto->toArray();

        if (empty(trim($data['descricao'] ?? ''))) {
            $data['descricao'] = 'Não foi colocado';
        }

        $updated = $this->categoriaModel->update($id, $data);

        return $updated;
    }

    public function count()
    {
        $result = $this->categoriaModel->query(
            'SELECT COUNT(*) as total FROM categorias'
        );

        if (!empty($result)) {
            $first = $result[0];
            return is_object($first) ? $first->total : $first['total'];
        }

        return 0;
    }
}
