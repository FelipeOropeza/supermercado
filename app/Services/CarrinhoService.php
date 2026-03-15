<?php

namespace App\Services;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Produto;

class CarrinhoService
{
    /**
     * Obtém o carrinho ativo do usuário
     */
    public function getActiveCart(int $usuarioId): Carrinho
    {
        $carrinho = (new Carrinho())
            ->where('usuario_id', '=', $usuarioId)
            ->where('status', '=', 'aberto')
            ->first();

        if (!$carrinho) {
            $id = (new Carrinho())->insert([
                'usuario_id' => $usuarioId,
                'status' => 'aberto'
            ]);
            $carrinho = (new Carrinho())->find($id);
        }

        return $carrinho;
    }

    /**
     * Adiciona um item ao carrinho
     */
    public function addItem(int $usuarioId, int $produtoId, int $quantidade = 1): bool
    {
        $carrinho = $this->getActiveCart($usuarioId);

        $item = (new CarrinhoItem())
            ->where('carrinho_id', '=', $carrinho->id)
            ->where('produto_id', '=', $produtoId)
            ->first();

        if ($item) {
            return $item->update($item->id, ['quantidade' => $item->quantidade + $quantidade]);
        }

        return (new CarrinhoItem())->insert([
            'carrinho_id' => $carrinho->id,
            'produto_id' => $produtoId,
            'quantidade' => $quantidade
        ]) > 0;
    }

    /**
     * Atualiza a quantidade de um item
     */
    public function updateItem(int $usuarioId, int $produtoId, int $quantidade): bool
    {
        $carrinho = $this->getActiveCart($usuarioId);

        $item = (new CarrinhoItem())
            ->where('carrinho_id', '=', $carrinho->id)
            ->where('produto_id', '=', $produtoId)
            ->first();

        if (!$item) {
            return false;
        }

        if ($quantidade <= 0) {
            return $item->delete($item->id);
        }

        return $item->update($item->id, ['quantidade' => $quantidade]);
    }

    /**
     * Remove um item do carrinho
     */
    public function removeItem(int $usuarioId, int $produtoId): bool
    {
        $carrinho = $this->getActiveCart($usuarioId);

        $item = (new CarrinhoItem())
            ->where('carrinho_id', '=', $carrinho->id)
            ->where('produto_id', '=', $produtoId)
            ->first();

        if ($item) {
            return $item->delete($item->id);
        }

        return false;
    }

    /**
     * Retorna todos os itens do carrinho com os dados do produto
     */
    public function getCartItems(int $usuarioId): array
    {
        $carrinho = $this->getActiveCart($usuarioId);
        $itens = $carrinho->itens();

        foreach ($itens as $item) {
            $item->produto = $item->produto();
        }

        return $itens;
    }

    /**
     * Limpa o carrinho
     */
    public function clearCart(int $usuarioId): bool
    {
        $carrinho = $this->getActiveCart($usuarioId);
        $itens = $carrinho->itens();

        foreach ($itens as $item) {
            $item->delete($item->id);
        }

        return true;
    }

    /**
     * Retorna a quantidade total de itens no carrinho
     */
    public function getCartCount(int $usuarioId): int
    {
        $carrinho = (new Carrinho())
            ->where('usuario_id', '=', $usuarioId)
            ->where('status', '=', 'aberto')
            ->first();

        if (!$carrinho) {
            return 0;
        }

        $db = \Core\Database\Connection::getInstance();
        $stmt = $db->prepare("SELECT SUM(quantidade) as total FROM carrinho_itens WHERE carrinho_id = ?");
        $stmt->execute([$carrinho->id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return (int)($result['total'] ?? 0);
    }
}
