@extends('site._partials.basic')

<title>Visualizar PDF</title>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-pdf.css') }}">
@endpush

@section('conteudo')
    @include('site._partials.header')

    <div class="section-logo">
        <div class="logo-content">
            <div class="image-logo">
                <img src="images/mecanico.png">
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
        <div class="section">
            <h2 class="dados-cliente">Dados do Cliente</h2>
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
            <div class="info-carro">
                <h2 class="dados-carro">Dados do Carro</h2>
                <div class="carro-info">
                    <div class="carro-info-column">
                        <p><strong>Carro:</strong> {{ $dadosServico['nome_carro'] }}</p>
                        <p><strong>Marca:</strong> {{ $dadosServico['marca'] }}</p>
                    </div>
                    <div class="carro-info-column">
                        <p><strong>Modelo:</strong> {{ $dadosServico['modelo'] }}</p>
                        <p><strong>Ano:</strong> {{ $dadosServico['ano'] }}</p>
                        <p><strong>Marca:</strong> {{ $dadosServico['placa'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dados dos Produtos -->
    <div class="section">
        <div class="section">
            <h2 class="produtos-servico">Produtos do Serviço</h2>
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
                        <td>{{ $produto['nome'] }}</td>
                        <td>{{ formatarValor($produto['valor_produto']) }}</td>
                        <td>{{ $produto['quantidade'] }}</td>
                        <td>{{ formatarValor($produto['valor_produto'] * $produto['quantidade']) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Div destacada para o orçamento -->
    <div class="section">
        <div class="section destacado">
            <h2 class="orcamento">Orçamento</h2>
            <div class="orcamento-info">
                <div class="destacado-label">Valor dos Produtos:</div>
                <div class="destacado-right">{{ $dadosServico['valor_produto'] }}</div>
                <div class="destacado-label">Valor da Mão de Obra:</div>
                <div class="destacado-right">{{ $dadosServico['valor_mao_obra'] }}</div>
                <div class="destacado-label">Valor Total do Serviço:</div>
                <div class="destacado-right">R$ {{ $dadosServico['valor_total'] }}</div>
            </div>
        </div>
    </div>

    <div class="container-buttons">
        <div class="button-container">
            <a href="{{ route('site.home') }}" class="button-voltar">
                Voltar para Home
            </a>
        </div>
        <div class="button-container">
            <a href="{{ route('site.exportar-pdf', ['dados_servico' => $dadosServico]) }}"
               class="btn btn-imprimir">Imprimir PDF</a>
        </div>
    </div>
@endsection

@php
    function formatarCPF($cpf): string
    {
        // Formata o CPF com pontos e traço
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    function formatarValor($valor): string
    {
    // Formata o valor com duas casas decimais
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
@endphp
