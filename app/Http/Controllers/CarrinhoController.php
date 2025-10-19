<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CarrinhoController extends Controller
{
    // Adicionar produto ao carrinho
    public function add(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->nome,
            'price' => $request->price,
            'quantity' => abs($request->qnt),
            'attributes' => [
                'image' => $request->image,
            ]
        ]);

       return redirect()->route('site.carrinho')->with('sucesso', 'Produto adicionado ao carrinho!');

    }

    // Listar itens do carrinho
    public function listar()
    {
        $itens = Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    // Remover item do carrinho
    public function remover($id)
    {
        Cart::remove($id);
        return redirect()->back()->with('sucesso', 'Produto removido!');
    }

    // Limpar carrinho
    public function limpar()
    {
        Cart::clear();
        return redirect()->back()->with('aviso', 'Carrinho limpo!');
    }

    public function atualizar(Request $request) {
        Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity),
            ],
        ]);
              return redirect()->route('site.carrinho')->with('sucesso', 'Produto atualizado ao carrinho!');
    }
}
