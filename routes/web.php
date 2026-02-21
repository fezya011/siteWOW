<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Гостевые маршруты
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Защищенные маршруты (требуется авторизация)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('createPost');

    // Админские маршруты - проверка роли будет в контроллере
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Профиль пользователя
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Публичные маршруты
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
Route::get('/about', [PostController::class, 'about'])->name('about');


