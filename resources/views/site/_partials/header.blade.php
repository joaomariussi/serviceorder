@push('styles')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endpush
<header class="admin-header">
    <div class="container-basic">
        <h1 class="header-title">Service Order</h1>
        <div class="form-group">
            @if(Auth::check())
                <p class="name-user">Olá, {{ $user->nome }}</p>
            @endif
        </div>
    </div>
</header>

<div class="menu">
    <nav>
        <a href="{{ route('site.home') }}">Início</a>
        <a href="#">Serviços</a>
        <a href="#">Contato</a>
        <a href="{{ route('logout') }}">Sair</a>
    </nav>
</div>

