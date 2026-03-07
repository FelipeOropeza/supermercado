<?php

use App\Controllers\AdminController;
use Core\Routing\Route;

// Grupo de rotas do Painel Administrativo
// Protegido pelo middleware 'admin' que será verificado
Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias.index');
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos.index');
    Route::get('/promocoes', [AdminController::class, 'promocoes'])->name('admin.promocoes.index');
    Route::get('/acessos', [AdminController::class, 'acessos'])->name('admin.acessos.index');
});
