@php use Carbon\Carbon; @endphp

@extends('site._partials.basic')

@section('title', 'Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('conteudo')
    <div class="wrapper">
        <div class="content">
            <div class="welcome-message">
                <h2 class="title-h2">Olá, {{ Auth::user()->nome }}</h2>
                <p class="mb-0">Bem-vindo ao seu Painel Administrativo</p>
            </div>

            <div class="dashboard">
                <div class="section-title">
                    <h3>Resumo Semanal</h3>
                </div>
                <div class="date-range">
                    <p>Dados desta semana, de {{ Carbon::now()->startOfWeek()->format('d/m/Y') }} até {{ Carbon::now()->endOfWeek()->format('d/m/Y') }}</p>
                </div>

                <div class="dashboard-cards">
                    <div class="card">
                        <h4>Vendas</h4>
                        <table>
                            <tr>
                                <td><i class="fas fa-shopping-cart"></i> Total de pedidos:</td>
                                <td>{{ $total_pedidos }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-money-bill-wave"></i> Valor total dos pedidos:</td>
                                <td>R$ {{ number_format($valor_total_pedidos, 2, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card">
                        <h4>Loja</h4>
                        <table>
                            <tr>
                                <td><i class="fas fa-user-plus"></i> Clientes novos:</td>
                                <td>{{ $total_clientes }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa-solid fa-boxes-stacked"></i> Total de produtos:</td>
                                <td>{{ $total_produtos }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
