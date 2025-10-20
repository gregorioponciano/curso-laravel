@extends('site.layout') {{-- Entendi! O @extends é como se fosse um molde principal da sua página. Quando você usa o @extends, você está dizendo que aquela view vai herdar um layout já existente, e aí você pode definir as seções específicas dentro desse layout. --}}
@section('title', 'home')
@section('conteudo')
<h1>Home</h1>

{{-- isso é um comentario --}}
{{-- isset($nome) ? 'sim' : 'não' --}}
{{-- $teste ?? 'não existe nome' --}}

{{-- (INVERSO DE IF)
@unless ($nome == 'rodrigo')
    true
@else
    false
@en         
--}}

{{--  
@switch($idade)
    @case(28)
        idade esta ok
        @break
    @case(30)
        idade esta errada
        @break

    @default
    deu ruim
        
@endswitch
--}}

{{--  
@isset($nome)
    <h2>Nome: {{$nome}}</h2>
    @endisset
--}}

{{--  
@empty($nome1) 
    nome vazio
@endempty
--}}

{{--  
@auth
    <h2>Autenticado</h2>
@endauth
--}}

{{--  (INVERSO DE AUTH)
@guest
    <h2>Não Autenticado</h2>
@endguest
--}}

{{--  (ESTRUTURA DE REPETIÇAO)
 @for ($i =0; $i <=10; $i++)
 <p>valor atual é {{ $i }} <br></p>
 @endfor
--}}

{{--  
@php $i = 0;
@endphp
@while ($i <= 15)
<p>Valor atual com while é {{ $i }} <br></p>
@php $i++ @endphp
@endwhile
--}}

{{--  
@foreach ($frutas as $fruta )
{{ $fruta }} <br>
@endforeach
--}}

{{-- 
@forelse($legumes as $legume)
{{ $legume }} <br>
@empty
    array esta vazio
@endforelse
 --}}


{{--@include('includes.mensagem', ['titulo' => 'Mensagem de susseso']) ---> @include é para incluir partes específicas de código, como um pedaço de template. --}}



@component('components.sidebar')
@slot('paragrafo')
Texto qualque vindo do slot
@endslot
@endcomponent



@push('style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
@endpush
@push('script')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
@endpush
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@endsection
