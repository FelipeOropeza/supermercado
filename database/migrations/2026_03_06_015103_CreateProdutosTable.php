<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreateProdutosTable
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('categoria_id')->unsigned();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('estoque')->default(0);
            $table->string('imagem_url')->nullable();
            $table->boolean('ativo')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
}
