@extends('site.layout')
@section('title', 'home')
@section('conteudo')


<div class="row container">
    @foreach ($produtos as $produto)
 <div class="col s12 m3">
        <div class="card">
        <div class="card-image">
          <img src="{{ $produto->imagem }}">
          <a href="{{ route('site.details', $produto->slug) }}" class="btn-floating halfway-fab waves-effect waves-light green"><i class="material-icons">visibility</i></a>
        </div>
        <div class="card-content">
            <span class="card-title">{{ \Illuminate\Support\Str::limit($produto->nome, 6) }}</span>
                  <p>{{ \Illuminate\Support\Str::limit($produto->descricao, 10) }}</p>
                  <p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
        </div>
      </div>
    </div>
    @endforeach

      <div class="row">
            <p>{{ $produtos->links('custom.pagination') }}</p>
      </div>

   

</div>

@endsection