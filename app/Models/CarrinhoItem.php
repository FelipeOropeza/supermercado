<?php

namespace App\Models;

use Core\Database\Model;

class CarrinhoItem extends Model
{
    protected ?string $table = 'carrinho_itens';

    protected array $fillable = [
        'carrinho_id',
        'produto_id',
        'quantidade'
    ];

    public function carrinho()
    {
        return $this->belongsTo(Carrinho::class, 'carrinho_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
