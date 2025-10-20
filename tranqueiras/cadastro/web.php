<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

// Página inicial
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// Login e Registro (somente visitantes)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Rotas de usuário autenticado
Route::middleware('auth')->group(function () {

    // Dashboard comum
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard'); // Admin vai pro painel
        }
        return view('dashboard'); // Usuário comum
    })->name('dashboard');

    // Painel do administrador
    Route::middleware('is_admin')->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard'); // Crie a view resources/views/admin/dashboard.blade.php
        })->name('admin.dashboard');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
