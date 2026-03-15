<?php

namespace App\Services;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Promocao;
use Core\Database\Connection;

class PedidoService
{
    private CarrinhoService $carrinhoService;

    public function __construct()
    {
        $this->carrinhoService = app(CarrinhoService::class);
    }

    /**
     * Cria um novo pedido a partir do carrinho do usuário
     */
    public function criarPedido(int $usuarioId, array $dados): int
    {
        $itens = $this->carrinhoService->getCartItems($usuarioId);
        
        if (empty($itens)) {
            throw new \Exception('Seu carrinho está vazio.');
        }

        return Connection::transaction(function() use ($usuarioId, $itens, $dados) {
            $total = 0;
            $itensPedidoData = [];

            foreach ($itens as $item) {
                $produto = $item->produto;
                $precoAtivo = $produto->preco;
                
                // Verifica promoção
                $today = date('Y-m-d H:i:s');
                $db = Connection::getInstance();
                $stmt = $db->prepare("SELECT preco_promocional FROM promocoes WHERE produto_id = ? AND data_inicio <= ? AND data_fim >= ? LIMIT 1");
                $stmt->execute([$produto->id, $today, $today]);
                $promo = $stmt->fetch(\PDO::FETCH_ASSOC);
                
                if ($promo) {
                    $precoAtivo = (float)$promo['preco_promocional'];
                }

                $total += $precoAtivo * $item->quantidade;

                $itensPedidoData[] = [
                    'produto_id' => $produto->id,
                    'quantidade' => $item->quantidade,
                    'preco_unitario_na_hora_da_compra' => $precoAtivo
                ];
            }

            $pedidoModel = new Pedido();
            $pedidoId = $pedidoModel->insert([
                'usuario_id' => $usuarioId,
                'endereco_entrega_id' => $dados['endereco_id'],
                'valor_total' => $total,
                'taxa_entrega' => 5.00, // Taxa fixa exemplo
                'forma_pagamento_entrega' => $dados['pagamento'],
                'necessita_troco_para' => $dados['troco'] ?? null,
                'status' => 'aguardando',
                'observacoes' => $dados['observacoes'] ?? null
            ]);

            $pedidoItemModel = new PedidoItem();
            foreach ($itensPedidoData as $itemData) {
                $pedidoItemModel->insert($itemData + ['pedido_id' => $pedidoId]);
            }

            // Limpa o carrinho
            $this->carrinhoService->clearCart($usuarioId);

            return $pedidoId;
        });
    }

    /**
     * Busca pedidos do usuário
     */
    public function getPedidosUsuario(int $usuarioId): array
    {
        return (new Pedido())->where('usuario_id', '=', $usuarioId)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Busca um pedido específico com seus itens e produtos
     */
    public function getPedidoWithItens(int $pedidoId, int $usuarioId): ?Pedido
    {
        return (new Pedido())
            ->where('id', '=', $pedidoId)
            ->where('usuario_id', '=', $usuarioId)
            ->with('itens', 'endereco')
            ->first();
    }
}
