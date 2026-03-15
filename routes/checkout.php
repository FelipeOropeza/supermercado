<?php

use App\Controllers\CheckoutController;
use Core\Routing\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/sucesso/{id}', [CheckoutController::class, 'sucesso'])->name('checkout.sucesso');
});
