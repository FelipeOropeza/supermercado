<?php

namespace App\Services;

use App\Models\Produto;
use App\DTOs\Admin\ProdutoDTO;

class ProdutoService
{
    private Produto $produtoModel;
    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    /**
     * Creates a new Produto.
     *
     * @param ProdutoDTO $dto
     * @return int
     * @throws \Exception
     */
    public function create(ProdutoDTO $dto): int
    {
        try {
            $data = $dto->toArray();

            // Se for um objeto de upload, salvamos o arquivo fisicamente e guardamos apenas o caminho (string) no banco
            if ($dto->imagem_url instanceof \Core\Http\UploadedFile) {
                $path = $dto->imagem_url->store('produtos', 'local');
                $data['imagem_url'] = $path;
            }

            return $this->produtoModel->insert($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        return $this->produtoModel->all();
    }

    public function getById($id)
    {
        return $this->produtoModel->find($id);
    }

    public function update($id, ProdutoDTO $dto)
    {
        try {
            $data = $dto->toArray();

            // Se for um objeto de upload, salvamos o arquivo fisicamente e guardamos apenas o caminho (string) no banco
            if ($dto->imagem_url instanceof \Core\Http\UploadedFile) {
                $path = $dto->imagem_url->store('produtos', 'local');
                $data['imagem_url'] = $path;
            }

            return $this->produtoModel->update($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        return $this->produtoModel->delete($id);    
    }
}
