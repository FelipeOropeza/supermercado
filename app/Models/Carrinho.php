<?php

namespace App\Models;

use Core\Database\Model;

class Carrinho extends Model
{
    protected ?string $table = 'carrinhos';

    protected array $fillable = [
        'usuario_id',
        'status'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function itens()
    {
        return $this->hasMany(CarrinhoItem::class, 'carrinho_id');
    }
}
