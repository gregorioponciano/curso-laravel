<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class SiteController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(4);
        $categoriasMenu = Categoria::all();

        return view('site.home', compact('produtos', 'categoriasMenu'));
    }

    public function details($slug)
    {
        $produto = Produto::where('slug', $slug)->firstOrFail();
        $categoriasMenu = Categoria::all();

        return view('site.details', compact('produto', 'categoriasMenu'));
    }

    public function categoria($id)
    {
        $produtos = Produto::where('id_categorias', $id)->paginate(4);
        $categoriasMenu = Categoria::all();

        return view('site.categoria', compact('produtos', 'categoriasMenu'));
    }
}
