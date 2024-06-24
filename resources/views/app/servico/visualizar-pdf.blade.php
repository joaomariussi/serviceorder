@extends('app._partials.basic')

<title>Visualizar PDF</title>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-pdf.css') }}">
@endpush

@section('conteudo')
    <div class="container">
        <div class="content-wrapper">
            <div class="section-logo">
                <div class="logo-content">
                    <div class="image-logo">
                        <img src="{{ asset('images/logo-02.png') }}" alt="Logo" class="logo">
                    </div>
                </div>
                <div class="text-content">
                    <div>
                        <h2>Service Order</h2>
                        <p>CNPJ: 12.345.678/0001-90</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Dados do Cliente</h2>
                <div class="cliente-info">
                    <div class="cliente-info-column">
                        <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                        <p><strong>Email:</strong> {{ $cliente->email }}</p>
                        <p><strong>CPF:</strong> {{ formatarCPF($cliente->cpf) }}</p>
                    </div>
                    <div class="cliente-info-column">
                        <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
                        <p><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
                        <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                        <p><strong>Bairro:</strong> {{ $cliente->bairro }}</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Dados do Carro</h2>
                <div class="carro-info">
                    <div class="carro-info-column">
                        <p><strong>Carro:</strong> {{ $dados_completo['nome_carro'] }}</p>
                        <p><strong>Marca:</strong> {{ $dados_completo['marca'] }}</p>
                    </div>
                    <div class="carro-info-column">
                        <p><strong>Modelo:</strong> {{ $dados_completo['modelo'] }}</p>
                        <p><strong>Ano:</strong> {{ $dados_completo['ano'] }}</p>
                        <p><strong>Placa:</strong> {{ $dados_completo['placa'] }}</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Produtos do Serviço</h2>
                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Nome do Produto</th>
                        <th>Valor Unitário</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dados_completo['produtos'] as $produto)
                        <tr>
                            <td>{{ $produto['nome'] }}</td>
                            <td>{{ formatarValor($produto['valor_produto']) }}</td>
                            <td>{{ $produto['quantidade'] }}</td>
                            <td>{{ formatarValor($produto['valor_produto'] * $produto['quantidade']) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Orçamento</h2>
                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Valor dos Produtos</td>
                        <td>{{ $dados_completo['valor_produto'] }}</td>
                    </tr>
                    <tr>
                        <td>Valor da Mão de Obra</td>
                        <td>{{ $dados_completo['valor_mao_de_obra'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Valor Total do Serviço</strong></td>
                        <td><strong>R$ {{ $dados_completo['valor_total'] }}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="container-buttons">
                <div class="button-container">
                    <a href="{{ route('site.home') }}" class="button-voltar">Voltar para Home</a>
                </div>
                <div class="button-container">
                    <a href="{{ route('app.servico.exportar-pdf', ['dados_completo' => $dados_completo]) }}"
                       class="btn-imprimir">Imprimir PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    function formatarCPF($cpf): string
    {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    function formatarValor($valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
@endphp
