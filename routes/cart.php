<?php

use App\Controllers\CarrinhoController;
use Core\Routing\Route;

Route::group(['prefix' => '/carrinho', 'middleware' => 'auth'], function () {
    Route::get('/', [CarrinhoController::class, 'index'])->name('carrinho');
    Route::get('/count', [CarrinhoController::class, 'count'])->name('carrinho.count');
    Route::post('/add/{id}', [CarrinhoController::class, 'add'])->name('carrinho.add');
    Route::post('/update/{id}', [CarrinhoController::class, 'update'])->name('carrinho.update');
    Route::post('/remove/{id}', [CarrinhoController::class, 'remove'])->name('carrinho.remove');
});
