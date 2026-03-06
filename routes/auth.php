<?php

use Core\Routing\Route;
use App\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/minha-conta', [\App\Controllers\MinhaContaController::class, 'index'])
    ->name('minha-conta')
    ->middleware(\App\Middleware\AuthMiddleware::class);

Route::get('/minha-conta/enderecos/novo', [\App\Controllers\MinhaContaController::class, 'createEndereco'])
    ->name('enderecos.create')
    ->middleware(\App\Middleware\AuthMiddleware::class);

Route::post('/minha-conta/enderecos/novo', [\App\Controllers\MinhaContaController::class, 'storeEndereco'])
    ->name('enderecos.store')
    ->middleware(\App\Middleware\AuthMiddleware::class);
