<?php

namespace App\Models;

use Core\Database\Model;

class Endereco extends Model
{
    protected ?string $table = 'enderecos';

    protected array $fillable = [
        'usuario_id',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
