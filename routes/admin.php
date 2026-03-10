<?php

use App\Controllers\AdminController;
use Core\Routing\Route;

// Grupo de rotas do Painel Administrativo
// Protegido pelo middleware 'admin' que será verificado
Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias.index');
    Route::get('/categorias/create', [AdminController::class, 'categoriasCreate'])->name('admin.categorias.create');
    Route::post('/categorias', [AdminController::class, 'categoriasStore'])->name('admin.categorias.store');
    Route::get('/categorias/{id}/edit', [AdminController::class, 'categoriasEdit'])->name('admin.categorias.edit');
    Route::post('/categorias/{id}/update', [AdminController::class, 'categoriasUpdate'])->name('admin.categorias.update');
    Route::post('/categorias/{id}', [AdminController::class, 'categoriasDestroy'])->name('admin.categorias.destroy');
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos.index');
    Route::get('/produtos/create', [AdminController::class, 'produtosCreate'])->name('admin.produtos.create');
    Route::post('/produtos', [AdminController::class, 'produtosStore'])->name('admin.produtos.store');
    Route::get('/produtos/{id}/edit', [AdminController::class, 'produtosEdit'])->name('admin.produtos.edit');
    Route::post('/produtos/{id}/update', [AdminController::class, 'produtosUpdate'])->name('admin.produtos.update');
    Route::post('/produtos/{id}', [AdminController::class, 'produtosDestroy'])->name('admin.produtos.destroy');
    Route::get('/promocoes', [AdminController::class, 'promocoes'])->name('admin.promocoes.index');
    Route::post('/promocoes', [AdminController::class, 'promocoesStore'])->name('admin.promocoes.store');
    Route::post('/promocoes/{id}/destroy', [AdminController::class, 'promocoesDestroy'])->name('admin.promocoes.destroy');
    Route::get('/acessos', [AdminController::class, 'acessos'])->name('admin.acessos.index');
});
