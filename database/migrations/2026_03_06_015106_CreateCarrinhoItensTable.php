<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreateCarrinhoItensTable
{
    public function up(): void
    {
        Schema::create('carrinho_itens', function (Blueprint $table) {
            $table->id();
            $table->integer('carrinho_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade')->default(1);
            $table->timestamps();

            $table->foreign('carrinho_id')->references('id')->on('carrinhos')->onDelete('CASCADE');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrinho_itens');
    }
}
