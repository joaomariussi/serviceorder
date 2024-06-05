@extends('site._partials.basic')

@section('title', 'Serviço Finalizado')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/servico-finalizado.css') }}">
@endpush

@section('conteudo')
    @include('site._partials.header')

    <main class="main-content">
        <section class="container-sucesso">
            <div class="content">
                <h1>Serviço Finalizado com Sucesso</h1>
                <p>O seu serviço foi finalizado com sucesso. Obrigado por utilizar nossos serviços!</p>
                <div class="botoes-navegacao">
                    <button type="button" onclick="window.location.href='{{ route('site.home') }}'" class="button-voltar">
                        Voltar para Home
                    </button>
                    <a href="{{ route('site.servico-pdf') }}" class="btn btn-imprimir">Visualizar Serviço</a>
                </div>
            </div>
        </section>
    </main>
@endsection
