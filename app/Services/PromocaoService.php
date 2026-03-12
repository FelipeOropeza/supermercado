<?php

namespace App\Services;

use App\DTOs\Admin\PromocaoDTO;
use App\Models\Promocao;

use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

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
        $data['destaque_folheto'] = $data['destaque_folheto'] ? 1 : 0;

        $id = $this->promocaoModel->insert($data);
        
        if ($id) {
            $this->notifyMercure('refresh');
        }

        return (bool)$id;
    }

    public function getAll(): array
    {
        return $this->promocaoModel->all();
    }

    public function delete(int|string $id): bool
    {
        $result = $this->promocaoModel->delete($id);
        
        if ($result) {
            $this->notifyMercure('deleted', $id);
        }

        return $result;
    }

    public function count(): int
    {
        return $this->promocaoModel->count();
    }

    /**
     * Notifica o Hub Mercure sobre mudanças nas promoções para atualização em tempo real no frontend.
     */
    private function notifyMercure(string $action, $id = null): void
    {
        // Usa o novo helper global padronizado
        broadcast('supermercado/promocoes', [
            'action' => $action, 
            'id' => $id,
            'time' => time()
        ]);
    }
}
