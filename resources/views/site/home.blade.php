@extends('site._partials.basic')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('conteudo')
    @include('site._partials.header')
    <div class="container-home">
        <h2>Bem-vindo ao Serviço de Ordem da Mecânica XYZ</h2>
        <p>
            Aqui na Mecânica XYZ, oferecemos uma ampla gama de serviços de reparo e manutenção automotiva.
            Desde troca de óleo até reparos mais complexos, nossa equipe está pronta para ajudar você a manter seu
            veículo em perfeitas condições.
            Utilize nosso serviço de ordem para agendar um horário e garantir um atendimento rápido e eficiente.
        </p>
        <button type="button" onclick="window.location.href='{{ route('site.servico') }}'"
                class="button-iniciar">
            Iniciar Serviço
        </button>
    </div>
@endsection
