<?php

namespace App\Services;

use App\DTOs\Admin\PromocaoDTO;
use App\Models\Promocao;

class PromocaoService
{
    private Promocao $promocaoModel;

    public function __construct()
    {
        $this->promocaoModel = app(Promocao::class);
    }

    public function create(PromocaoDTO $dto): bool
    {
        $data = $dto->toArray();
        if ($data['destaque_folheto'] == true) {
            $data['destaque_folheto'] = 1;
        } else {
            $data['destaque_folheto'] = 0;
        }

        return $this->promocaoModel->insert($data);
    }

    public function getAll(): array
    {
        return $this->promocaoModel->all();
    }

    public function delete(int|string $id): bool
    {
        return $this->promocaoModel->delete($id);
    }
}
