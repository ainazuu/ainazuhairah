<?php

use Illuminate\Support\Facades\Route;
// use PasswordController
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PizzaController;

Route::get('/', function () {
    return view('home');
});

// password generator
Route::get('/password', [PasswordController::class, 'index']);

// generate post
Route::post('/generate', [PasswordController::class, 'generate']);

Route::get('/order', [PizzaController::class, 'showOrderForm'])->name('order.show');
Route::post('/order', [PizzaController::class, 'addToCart'])->name('order.add');
Route::get('/cart', [PizzaController::class, 'showCart'])->name('cart.show');
Route::post('/cart', [PizzaController::class, 'clearCart'])->name('cart.clear');


