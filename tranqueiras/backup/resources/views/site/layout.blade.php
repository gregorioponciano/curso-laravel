<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <!-- Compiled and minified CSS -->
    <title>@yield('title')</title>
    @stack('style')
</head>
<body>
    @yield('conteudo')
    <p>esse texto veio do  yield do layout</p>
    

    @stack('script')
    <!-- Compiled and minified JavaScript -->


</body>
</html>