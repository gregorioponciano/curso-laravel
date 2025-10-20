<h1>Bem-vindo ao Painel Administrativo, {{ Auth::user()->name }}</h1>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Sair
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
