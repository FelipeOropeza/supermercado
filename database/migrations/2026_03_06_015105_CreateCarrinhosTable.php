<?php

namespace App\Database\Migrations;

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class CreateCarrinhosTable
{
    public function up(): void
    {
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id')->unsigned();
            $table->string('status', 20)->default('aberto');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrinhos');
    }
}
