<?php

namespace App\Models;

use Core\Database\Model;

class Produto extends Model
{
    protected ?string $table = 'produtos';

    protected array $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'preco',
        'estoque',
        'imagem_url',
        'ativo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function promocoes()
    {
        return $this->hasMany(Promocao::class, 'produto_id');
    }
}
