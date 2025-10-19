@extends('site.layout') 
@section('title', 'Detalhes do Produto')
@section('conteudo')

<button onclick="window.history.go(-1)"><i class="material-icons">arrow_back</i></button>
<div class="row container">
    <div class="col s12 m6">
          <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" class="responsive-img" style="width: 300px;">


            <h3>{{ $produto->nome }}</h3>
            <h5>R$ {{ number_format($produto->preco, 2, ',', '.') }}</h5>
            <p>{{ $produto->descricao }}</p>
            <p>Vendedor: {{ $produto->user->firstName }}</p>
            <p>Categoria: {{ $produto->categoria->nome }}</p>
            <form action="{{ route('site.addcarrinho') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $produto->id }}">
            <input type="hidden" name="nome" value="{{ $produto->nome }}">
            <input type="hidden" name="price" value="{{ number_format($produto->preco, 2, ',', '.') }}">
            <input type="number" name="qnt" value="1" min="1">
            <input type="hidden" name="image" value="{{ $produto->imagem }}">
            <input type="submit" value="comprar" class="btn orange btn-large">
            </form>
    </div>
    <div class="col s12 m6">

    </div>
</div>

@endsection