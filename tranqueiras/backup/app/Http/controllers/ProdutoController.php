<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return "produtos controller";
    }


    public function show($id = 0)
    {
        return "rota de shows" . $id;
    }
}
