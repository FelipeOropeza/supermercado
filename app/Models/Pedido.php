<?php

namespace App\Models;

use Core\Database\Model;

class Pedido extends Model
{
    protected ?string $table = 'pedidos';

    protected array $fillable = [
        'usuario_id',
        'endereco_entrega_id',
        'valor_total',
        'taxa_entrega',
        'forma_pagamento_entrega',
        'necessita_troco_para',
        'status',
        'observacoes',
        'notificado_em'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_entrega_id');
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class, 'pedido_id');
    }
}
