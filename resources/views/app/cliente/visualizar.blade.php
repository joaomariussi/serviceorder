@extends('app._partials.basic')

@section('title', 'Visualizar Cliente '. $cliente->id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-cliente.css') }}">
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="informacoes">
            <div class="coluna-informacoes">
                <h3>Informações do Cliente</h3>
                <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>
                <p><strong>Cliente Criado em:</strong> {{ $cliente->created_at->format('d/m/Y H:i') }}</p>
                <div class="button-container">
                    <a href="{{ route('app.cliente') }}" class="button-voltar">Voltar</a>
                </div>
            </div>
        </div>

        <div class="resumo-cliente">
            <div class="card">
                <i class="fas fa-shopping-cart fa-2x"></i>
                <h4>Pedidos Realizados</h4>
                <br>
                <p>{{ $cliente->servico->count() }}</p>
            </div>

            <div class="card">
                <i class="fas fa-dollar-sign fa-2x"></i>
                <h4>Valor Total Gasto</h4>
                <br>
                <p>R$ {{ number_format($cliente->servico->sum('valor_total'), 2, ',', '.') }}</p>
            </div>
        </div>

        <div class="pedidos-cliente">
            <h3 class="title-pedidos-cliente">Pedidos Realizados pelo Cliente</h3>
            <table>
                <thead>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Data do Pedido</th>
                    <th>Valor Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cliente->servico as $servico)
                    <tr>
                        <td>{{ $servico->id }}</td>
                        <td>{{ $servico->created_at->format('d/m/Y H:i') }}</td>
                        <td>R$ {{ number_format($servico->valor_total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="{{ asset('js/scripts.js') }}"></script>
