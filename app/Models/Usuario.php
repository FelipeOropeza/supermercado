<?php

namespace App\Models;

use Core\Database\Model;

class Usuario extends Model
{
    protected ?string $table = 'usuarios';

    protected array $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
        'telefone',
        'role'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'usuario_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'usuario_id');
    }

    public function carrinhos()
    {
        return $this->hasMany(Carrinho::class, 'usuario_id');
    }
}
