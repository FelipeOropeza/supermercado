<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreatePedidoItensTable
{
    public function up(): void
    {
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade');
            $table->decimal('preco_unitario_na_hora_da_compra', 10, 2);
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('CASCADE');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
    }
}
