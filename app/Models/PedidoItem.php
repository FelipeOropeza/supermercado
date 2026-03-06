<?php

namespace App\Models;

use Core\Database\Model;

class PedidoItem extends Model
{
    protected ?string $table = 'pedido_itens';

    protected array $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario_na_hora_da_compra'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
