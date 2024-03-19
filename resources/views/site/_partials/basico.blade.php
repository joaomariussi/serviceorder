<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Serviço de Ordem - Mecânica XYZ - @yield('titulo')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<header class="admin-header">
    <h1 class="header-title">Serviço de Ordem - Mecânica XYZ</h1>
    @if(Auth::check())
        <p>Olá, {{ $user->nome }}</p>
    @endif
</header>

<body>
@yield('conteudo')
</body>




