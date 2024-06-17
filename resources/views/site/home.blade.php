@extends('site._partials.basic')

@section('title', 'Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('conteudo')
    <div class="wrapper">
        <div class="content">
            <div class="container-home">
                <h2 class="title-h2">Olá, {{ Auth::user()->nome }}</h2>
                <h2>Bem-vindo ao seu Painel Administrativo</h2>
                <button type="button" onclick="window.location.href='{{ route('site.servico') }}'"
                        class="button-iniciar">
                    Iniciar Serviço
                </button>
            </div>

            <div class="dashboard">
                <div class="card card-pedidos">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                    <h3>Pedidos</h3>
                    <p>Pedidos realizados</p>
                    <p>{{ $total_pedidos }}</p>
                </div>
                <div class="card card-clientes">
                    <i class="fas fa-users fa-3x"></i>
                    <h3>Clientes</h3>
                    <p>Total de clientes</p>
                    <p>{{ $total_clientes }}</p>
                </div>
                <div class="card card-produtos">
                    <i class="fas fa-boxes fa-3x"></i>
                    <h3>Produtos</h3>
                    <p>Total de produtos</p>
                    <p>{{ $total_produtos }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
