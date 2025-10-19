@extends('site.footer')

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            padding-top: 64px;
        }
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
        }
    </style>
</head>
<body>

@php 
    use App\Models\Categoria; 
    $categoriasMenu = Categoria::all();
@endphp

<!-- Dropdown de Categorias -->
<ul id="dropdown1" class="dropdown-content">
    @foreach ($categoriasMenu as $categoriaM)
        <li><a href="{{ route('site.categoria', $categoriaM->id) }}">{{ $categoriaM->nome }}</a></li>
    @endforeach
</ul>
<!-- Dropdown de Categorias -->
<ul id="dropdown2" class="dropdown-content">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('login.logout') }}">Sair</a></li>
</ul>
<!-- Dropdown de Categorias -->
<ul id="dropdown3" class="dropdown-content">
        <li><a href="{{ route('login.form') }}">Login</a></li>
</ul>

<!-- Navbar -->
<nav class="green">
    <div class="nav-wrapper container">
        <a href="{{ route('site.index') }}" class="brand-logo center">Laravel</a>
        <ul id="nav-mobile" class="left">
            <li><a href="{{ route('site.index') }}">Home</a></li>
            <li><a href="#" class="dropdown-trigger" data-target="dropdown1">Categorias <i class="material-icons right">expand_more</i></a></li>
            <li><a href="{{ route('site.carrinho') }}">Carrinho<span class="new badge blue" data-badge-caption="">{{ \Cart::getContent()->count() }}</span></a></li>
        </ul>

        @auth
         <ul id="nav-mobile" class="right">
            <li><a href="#" class="dropdown-trigger" data-target="dropdown2">Olá {{ auth()->user()->firstName }} <i class="material-icons right">expand_more</i></a></li>
        </ul>
        @else
         <ul id="nav-mobile" class="right">
            <li><a href="{{ route('login.form') }}" class="dropdown-trigger" data-target="dropdown3">Login <i class="material-icons right">expand_more</i></a></li>
        </ul>
        @endauth

    </div>
</nav>

<!-- Conteúdo das páginas -->
@yield('conteudo')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.dropdown-trigger');
        M.Dropdown.init(elems, {coverTrigger: false});
    });
</script>

</body>
</html>
