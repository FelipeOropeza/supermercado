<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreatePromocoesTable
{
    public function up(): void
    {
        Schema::create('promocoes', function (Blueprint $table) {
            $table->id();
            $table->integer('produto_id')->unsigned();
            $table->decimal('preco_promocional', 10, 2);
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->boolean('destaque_folheto')->default(0);
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promocoes');
    }
}
