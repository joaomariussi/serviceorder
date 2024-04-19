@extends('site._partials.basic')
<title>Visualizar PDF</title>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-pdf.css') }}">
@endpush

@section('conteudo')
    @include('site._partials.header')
    <div class="section">
        <h1>Detalhes do Serviço</h1>
        <div class="info-cliente">
            <h2>Dados do Cliente</h2>
            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>CPF:</strong> {{ formatarCPF($cliente->cpf) }}</p>
        </div>
        <div class="info-carro">
            <h2>Dados do Carro</h2>
            <p><strong>Carro:</strong> {{ $dadosServico['nome_carro'] }}</p>
            <p><strong>Marca:</strong> {{ $dadosServico['marca'] }}</p>
            <p><strong>Modelo:</strong> {{ $dadosServico['modelo'] }}</p>
            <p><strong>Ano:</strong> {{ $dadosServico['ano'] }}</p>
            <p><strong>Marca:</strong> {{ $dadosServico['placa'] }}</p>
        </div>
        <div class="info-servico">
            <h2>Detalhes do Serviço</h2>
            <p><strong>Valor dos Produtos:</strong> {{ $dadosServico['valor_produto'] }}</p>
            <p><strong>Valor da Mão de Obra:</strong> {{ $dadosServico['valor_mao_obra'] }}</p>
            <p><strong>Valor Total do Serviço:</strong> R$ {{ $dadosServico['valor_total'] }}</p>
        </div>
    </div>

    <!-- Dados dos Produtos -->
    <div class="section">
        <h2>Produtos do Serviço</h2>
        <table>
            <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Valor Unitário</th>
                <th>Quantidade</th>
                <th>Valor Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dadosServico['produtos'] as $produto)
                <tr>
                    <td>{{ $produto['nome_produto'] }}</td>
                    <td>R$ {{ $produto['valor_produto'] }}</td>
                    <td>{{ $produto['quantidade'] }}</td>
                    <td>R$ {{ $produto['valor_produto'] * $produto['quantidade'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botão para imprimir -->
    <button type="button" class="btn-imprimir" onclick="window.print()">Imprimir PDF</button>

@endsection

@php
    function formatarCPF($cpf): string
    {
        // Formatar o CPF com pontos e traço
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
@endphp
