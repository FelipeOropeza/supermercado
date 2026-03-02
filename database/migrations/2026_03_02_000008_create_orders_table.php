<?php

use Core\Database\Schema\Schema;
use Core\Database\Schema\Blueprint;

class create_orders_table
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('SET NULL');
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pendente');
            $table->string('payment_method')->default('dinheiro');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
