@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endpush

<div class="wrapper">
    <div class="sidebar">
        <div class="logo-menu">
            <a href="{{ route('site.home') }}">
                <img src="{{ asset('images/logo-02.png') }}" alt="Logo" class="logo">
            </a>
        </div>
        <ul class="menu">
            <li><a href="{{ route('site.home') }}">Dashboard</a></li>
            <li class="submenu">
                <a href="{{ route('app.cliente') }}">Clientes</a>
                <ul class="submenu-items">
                    <li><a href="#">Novo Cliente</a></li>
                    <li><a href="{{ route('app.cliente')}}">Visualizar Clientes</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">Serviços</a>
                <ul class="submenu-items">
                    <li><a href="{{ route('app.servico.servico')}}">Novo Serviço</a></li>
                    <li><a href="{{ route('app.servico.index') }}">Visualizar Serviços</a></li>
                </ul>
            </li>
            <li><a href="{{ route('logout') }}">Sair</a></li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.submenu > a').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                const parentLi = this.parentElement;
                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                    parentLi.classList.remove('open');
                } else {
                    document.querySelectorAll('.submenu-items').forEach(function(sub) {
                        sub.style.display = 'none';
                        sub.parentElement.classList.remove('open');
                    });
                    submenu.style.display = 'block';
                    parentLi.classList.add('open');
                }
            });
        });
    });
</script>

