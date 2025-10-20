<?php

/*este aqui fo gerado no comando 
    php artisan make:controller ProdutoControllers --resource
    ele cria um controller com os metodos basicos de CRUD
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Listagem de produtos";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Formulário de criação de produto";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lógica para armazenar o produto
        return "Produto criado com sucesso!";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Exibindo produto com ID: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Formulário de edição do produto com ID: " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lógica para atualizar o produto
        return "Produto com ID: " . $id . " atualizado com sucesso!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lógica para deletar o produto
        return "Produto com ID: " . $id . " deletado com sucesso!";
    }
}
