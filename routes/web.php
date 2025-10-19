<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Página inicial
Route::get('/', [SiteController::class, 'index'])->name('site.index');

// Produtos
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details');
Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

// Carrinho
Route::post('/addcarrinho', [CarrinhoController::class, 'add'])->name('site.addcarrinho');
Route::get('/carrinho', [CarrinhoController::class, 'listar'])->name('site.carrinho');
Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover'); 
Route::delete('/carrinho/limpar', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar'); 
Route::put('/carrinho/atualizar', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar'); 



Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

