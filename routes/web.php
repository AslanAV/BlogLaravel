<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth-page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/dashboard', function () {
    return response(200);
})
    ->name('dashboard-page')
    ->middleware(SimpleAuth::class);