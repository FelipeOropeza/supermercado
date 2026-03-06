<?php

use App\Controllers\UsuarioController;
use App\Controllers\AuthController;
use Core\Routing\Route;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas do Usuário
Route::group(['prefix' => '/minha-conta', 'middleware' => 'auth'], function () {
    Route::get('/', [UsuarioController::class, 'profile'])->name('minha-conta');
    Route::get('/enderecos/novo', [UsuarioController::class, 'createEndereco'])->name('enderecos.create');
    Route::post('/enderecos/novo', [UsuarioController::class, 'storeEndereco'])->name('enderecos.store');
    Route::get('/enderecos/editar/{id}', [UsuarioController::class, 'editEndereco'])->name('enderecos.edit');
    Route::post('/enderecos/editar/{id}', [UsuarioController::class, 'updateEndereco'])->name('enderecos.update');
    Route::post('/enderecos/excluir/{id}', [UsuarioController::class, 'deleteEndereco'])->name('enderecos.delete');
});
