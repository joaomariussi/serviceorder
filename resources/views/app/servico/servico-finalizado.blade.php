@extends('app._partials.basic')

@section('title', 'Serviço Finalizado')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/servico-finalizado.css') }}">
@endpush

@section('conteudo')
    <main class="main-content">
        <section class="container-sucesso">
            <div class="content">
                <h1>Serviço Finalizado com Sucesso</h1>
                <p>O seu serviço foi finalizado com sucesso. Obrigado por utilizar nossos serviços!</p>

                <!-- Exibir produtos trocados -->
                <p><strong>Produtos Trocados</strong></p>
                <ul>
                    @foreach($dados_completo['produtos'] as $produto)
                        <li>{{ $produto['nome'] }} - R$ {{ number_format(floatval($produto['valor_produto']), 2, ',', '.') }}</li>
                    @endforeach
                </ul>

                <p><strong>Valor da Mão de Obra:</strong>
                    {{ $dados_completo['valor_mao_de_obra'] }}
                </p>

                <p><strong>Valor Total:</strong> R$ {{ number_format(floatval($dados_completo['valor_total']), 2, ',', '.') }}</p>

                <div class="container-buttons">
                    <a href="{{ route('site.home') }}" type="button" class="button-voltar">
                        Voltar para Home
                    </a>
                    <a href="{{ route('app.servico.visualizar', ['id' => $servico->id]) }}" class="btn btn-imprimir">
                        Visualizar Serviço
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
