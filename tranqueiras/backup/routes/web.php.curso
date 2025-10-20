<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*Route::get('/empresa', 'site/empresa');*/
Route::get('/empresa', function () {
return view('site.empresa');
});

Route::any('/any', function () {
    return "Permite todo tipo de http (put, delete, gete, post)";
});

Route::match(['put', 'delete'],'/match', function () {
    return "Permite apenas acessos definidos";
});

Route::get('/produto/{id}/{cat?}', function($id, $cat = '') {
    return "Rota de produto " . $id . "<br> Categoria: " . $cat;
});

/*Route::redirect('/sobre', '/empresa');*/
Route::get('/sobre', function(){
    return redirect('/empresa');
});

/*A rotas timesnews mudou mais o name nao        */
Route::get('/timesnews', function () {
    return view('news');
})->name('noticias');

Route::get('/novidades', function () {
    return redirect()->route('noticias');
});


                /*grupo usando Prefix*/
/*Route::prefix('vaso')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/users', function () {
        return 'users';
    });

    Route::get('/clientes', function () {
        return 'clientes';
    });
});*/



                /*grupo usando name (O NAME SO CONSEGUI USAR OUTRO APENAS ADMIN OUTRO NAO FUNCIONA JA O PREFIX FUNCIONOU)*/
/*Route::name('admin.')->group(function () {

    Route::get('admin/index', function () {
        return('index');
    })->name('index');

    Route::get('admin/users', function () {
        return 'user';
    })->name('user');

    Route::get('admin/cliente', function () {
        return 'cliente';
    })->name('cliente');
});
*/

  /*                agrupa tanto o nome quanto o prefix
                    apenas a rota /cliente esta funcionando porque eu 
                    especifiquei os nomes e prefix encima do codigo
                    (eu deixei assim poque tambem funciona passando os nomes e prefix
                    encima do codigo, mas o nome e prefixo tem que ser o mesmo)
  */
Route::group([
    'prefix' => 'admin',            // Prefixo para todas as rotas
    'as' => 'admin.',               // Prefixo para os nomes das rotas
], function() {
    Route::get('admin/index', function () {
        return('index');
    })->name('admin.index');

    Route::get('admin/users', function () {
        return 'user';
    })->name('admin.users');

    Route::get('clientes', function () {
        return 'clientes';
    })->name('clientes');
});


