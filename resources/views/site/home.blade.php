<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviço de Ordem - Mecânica XYZ</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<body>
<header class="admin-header">
    <h1 class="header-title">Serviço de Ordem - Mecânica XYZ</h1>
    @if(Auth::check())
        <p>Olá, {{ $user->nome }}</p>
    @endif
</header>
<nav>
    <a href="{{ route('site.home') }}">Início</a>
    <a href="#">Serviços</a>
    <a href="#">Contato</a>
    <a href="{{ route('logout') }}">Sair</a>
</nav>
<div class="container">
    <h2>Bem-vindo ao Serviço de Ordem da Mecânica XYZ</h2>
    <p>
        Aqui na Mecânica XYZ, oferecemos uma ampla gama de serviços de reparo e manutenção automotiva.
        Desde troca de óleo até reparos mais complexos, nossa equipe está pronta para ajudar você a manter seu veículo em perfeitas condições.
        Utilize nosso serviço de ordem para agendar um horário e garantir um atendimento rápido e eficiente.
    </p>
    <a href="#" class="button">Agendar Serviço</a>
</div>
</body>
</html>
