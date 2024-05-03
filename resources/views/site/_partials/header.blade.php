@push('styles')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endpush

<div class="wrapper">
    <div class="content">
        <header class="admin-header">
            <div class="container-basic">
                <h1 class="header-title">Service Order</h1>
                <div class="form-group-user">
                    @if(Auth::check())
                        <p class="name-user">Olá, {{ $user->nome }}</p>
                    @endif
                </div>
            </div>
        </header>
    </div>

    <div class="sidebar">
        <ul class="menu">
            <li><a href="#">Dashboard</a></li>
            <li class="submenu" id="clientes-submenu">
                <a href="#">Clientes</a>
                <ul>
                    <li><a href="#">Novo Cliente</a></li>
                    <li><a href="#">Visualizar Clientes</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">Serviços</a>
                <ul>
                    <li><a href="#">Novo Serviço</a></li>
                    <li><a href="#">Visualizar Serviços</a></li>
                </ul>
            </li>
            <li><a href="#">Sobre Nós</a></li>
            <li><a href="#">Contato</a></li>
            <li><a href="#">Sair</a></li>
        </ul>
    </div>
</div>




