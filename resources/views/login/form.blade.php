@extends('site.layout')
@section('title', 'login')


@if ($mensagem = Session::get('erro'))
{{ $mensagem }}
    
@endif

@if ($errors->any())
@foreach ($errors->all() as $error) 
{{ $error }}
    
@endforeach

    
@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf
    Email: <br> <input type="email" name="email"> <br>
    Senha: <br> <input type="password" name="password"> <br>
    <button type="submit">Entrar</button>
</form>