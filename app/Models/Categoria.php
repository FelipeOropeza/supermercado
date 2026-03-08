<?php

namespace App\Models;

use Core\Database\Model;

class Categoria extends Model
{
    protected ?string $table = 'categorias';

    protected array $fillable = [
        'nome',
        'descricao',
        'deleted_at'
    ];

    public bool $softDeletes = true;

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'categoria_id');
    }
}
