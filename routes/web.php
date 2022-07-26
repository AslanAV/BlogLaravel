<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts')->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth-page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware(SimpleAuth::class);

Route::resource('posts', PostController::class);