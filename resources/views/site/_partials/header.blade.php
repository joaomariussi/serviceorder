@push('styles')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endpush

<div class="wrapper">
    <div class="content">
        <header class="admin-header">
            @include('flash::message')
        </header>
    </div>

    <div class="sidebar">
        <div class="logo-menu">
            <a href="{{ route('site.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </a>
        </div>
        <ul class="menu">
            <li><a href="{{ route('site.home') }}">Dashboard</a></li>
            <li class="submenu" id="clientes-submenu">
                <a href="{{ route('site.cliente')}}">Clientes</a>
                <ul>
                    <li><a href="#">Novo Cliente</a></li>
                    <li><a href="{{ route('site.cliente')}}">Visualizar Clientes</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="{{ route('site.servico')}}">Serviços</a>
                <ul>
                    <li><a href="{{ route('site.servico')}}">Novo Serviço</a></li>
                    <li><a href="#">Visualizar Serviços</a></li>
                </ul>
            </li>
            <li><a href="#">Sobre Nós</a></li>
            <li><a href="#">Contato</a></li>
            <li><a href="{{ route('logout') }}">Sair</a></li>
        </ul>
    </div>
</div>




