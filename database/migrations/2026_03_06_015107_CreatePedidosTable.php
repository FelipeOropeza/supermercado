<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreatePedidosTable
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id')->unsigned();
            $table->integer('endereco_entrega_id')->unsigned();
            $table->decimal('valor_total', 10, 2);
            $table->decimal('taxa_entrega', 10, 2)->default(0);
            $table->string('forma_pagamento_entrega', 50);
            $table->decimal('necessita_troco_para', 10, 2)->nullable();
            $table->string('status', 50)->default('pendente');
            $table->text('observacoes')->nullable();
            $table->timestamp('notificado_em')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('CASCADE');
            $table->foreign('endereco_entrega_id')->references('id')->on('enderecos')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
}
