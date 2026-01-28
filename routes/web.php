<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('home');
Route::get('/posts/create', [PostController::class, 'create'])->name('createPost');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('showPostBySlug');
Route::get('/about', [PostController::class, 'about'])->name('about');

Route::post('/posts', [PostController::class, 'store'])->name('posts');

