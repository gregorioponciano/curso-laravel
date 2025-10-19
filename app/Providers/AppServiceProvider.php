<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Compartilha a variável $categoriasMenu com TODAS as views
        View::composer('*', function ($view) {
            $view->with('categoriasMenu', Categoria::all());
        });
    }
}
