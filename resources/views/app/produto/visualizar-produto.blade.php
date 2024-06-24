@extends('app._partials.basic')

@section('title', 'Visualizar Produto'. $produto->id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-produto.css') }}">
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="informacoes">
            <div class="coluna-informacoes">
                <h3>Informações do produto</h3>
                <p><strong>Código do produto:</strong> {{ $produto->codigo }}</p>
                <p><strong>Produto criado em:</strong> {{ $produto->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Vendido:</strong> {{ $quantidadeVendas }} vezes</p>
                <div class="button-container">
                    <a href="{{ route('app.produto.index') }}" class="button-voltar">Voltar</a>
                </div>
            </div>
        </div>

        <div class="resumo-servico">
            <div class="card">
                <i class="fas fa-dollar-sign fa-2x"></i>
                <h4>Preço do Produto</h4>
                <br>
                <p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
            </div>

            <div class="card">
                <i class="fas fa-boxes fa-2x"></i>
                <h4>Quantidade de Estoque</h4>
                <br>
                <p>{{ $produto->quantidade }}</p>
            </div>
        </div>

        <div class="produtos-servico">
            <h3 class="title-produtos-servico">Produtos</h3>
            <table>
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Código Produto</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->codigo }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="pedidos-produto">
            <h3 class="title-pedidos-produto">Pedidos que contêm este produto</h3>
            <table>
                <thead>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Data do Pedido</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $pedido->quantidade }}</td>
                        <td>R$ {{ number_format($pedido->servico->valor_total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="{{ asset('js/scripts.js') }}"></script>
