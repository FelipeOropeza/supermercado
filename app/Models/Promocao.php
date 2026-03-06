<?php

namespace App\Models;

use Core\Database\Model;

class Promocao extends Model
{
    protected ?string $table = 'promocoes';

    protected array $fillable = [
        'produto_id',
        'preco_promocional',
        'data_inicio',
        'data_fim',
        'destaque_folheto'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
