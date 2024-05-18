@extends('site._partials.basic')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/servico-finalizado.css') }}">
@endpush

@section('conteudo')
    @include('site._partials.header')

    <div class="main-content">
        <div class="container-sucesso">
            <div class="container">
                <h1>Serviço Finalizado com Sucesso</h1>
                <p>O seu serviço foi finalizado com sucesso. Obrigado por utilizar nossos serviços!</p>
                <div class="botoes-navegacao">
                    <button type="button" onclick="window.location.href='{{ route('site.home') }}'" class="button-voltar">
                        Voltar para Home
                    </button>
                    <div class="button-container">
                        <a href="{{ route('site.servico-pdf') }}" class="btn btn-imprimir">Visualizar Serviço</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
