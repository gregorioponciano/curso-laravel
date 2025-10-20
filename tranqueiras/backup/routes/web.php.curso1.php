<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoControllers;

Route::get('/',  [ProdutoController::class, 'index']);

Route::get('/show/{id?}',  [ProdutoController::class, 'show']);

Route::resource('produtos', ProdutoControllers::class);
