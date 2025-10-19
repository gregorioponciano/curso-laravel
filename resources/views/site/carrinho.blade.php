@extends('site.layout')
@section('title', 'Carrinho')
@section('conteudo')

    @if ($mensagem = Session::get('sucesso'))

        <div class="card green darken-1">
            <div class="card-content white-text">
            <span class="card-title">Parabéns!</span>
            <p>{{$mensagem}}</p>
            </div>
        </div>
    @endif

    @if ($mensagem = Session::get('aviso'))

      <div class="card blue darken-1">
        <div class="card-content white-text">
          <span class="card-title">Tudo bem!</span>
        <p>{{$mensagem}}</p>
        </div>
      </div>
    @endif

    @if ($itens->count() == 0)
         <div class="card orange darken-1">
        <div class="card-content white-text">
          <span class="card-title">Seu carrinho está vazio</span>
        <p>Aproveite nossas promoções!</p>
        </div>
      </div>
    @else
         <div class="row container">
        <h3>Seus carrinho possui {{$itens->count()}}</h3>
        <button class="" onclick="window.location.href='/'"><i class="material-icons">arrow_back</i></button>
        <table class="striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td><img src="{{ $item->attributes->image }}" width="170" class="responsive-img" alt="img" ></td>
                        <td>{{ $item->name }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>

                        {{-- BTN ATUALIZAR --}}
                        <form action="{{ route('carrinho.atualizar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" style="width: 40px; font-weight: 900;" class="white center" min="1">
                            </td>
                        <input type="hidden" name="id" value="{{ $item->id }}">
                            <td>  <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button></td>
                        </form>
                        <td>
                                {{-- BTN REMOVER --}}
                            <form action="{{ route('carrinho.remover', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-floating  waves-effect waves-light red"><i class="material-icons">delete</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row container center">
            <h4>Total: R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}</h4>
        </div>
        <form action="{{ route('carrinho.limpar') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-floating btn-large  waves-effect waves-light red"><i class="material-icons">clear</i></button>
            <button type="submit" class="btn-floating btn-large  waves-effect waves-light green"><i class="material-icons">check</i></button>
        </form>

    </div>
    @endif

   
@endsection
