<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{id}', [HomeController::class,'detail'])->name('detail-product');
Route::post('/payment', [HomeController::class,'payment'])->name('payment');
Route::get('/notification/{id}', [HomeController::class,'notification'])->name('notification');