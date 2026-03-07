<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreateCategoriasTable
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
}
