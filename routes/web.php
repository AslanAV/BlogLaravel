<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth-page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::view('/posts/create', 'post.create')
    ->name('create-post-page')
    ->middleware(SimpleAuth::class);

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts-page');

Route::post('/posts', [PostController::class, 'store'])
    ->name('create-post')
    ->middleware(SimpleAuth::class);

Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('show-post-page');