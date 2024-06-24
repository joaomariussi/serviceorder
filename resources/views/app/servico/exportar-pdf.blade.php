<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-02.png') }}">
    <title>Visualizar PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .cliente-carro-info {
            display: flex;
            justify-content: space-between;
        }

        .cliente-info-column, .carro-info-column {
            width: 48%;
        }

        .cliente-info-column p, .carro-info-column p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .highlight {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .highlight div {
            margin-bottom: 10px;
        }

        .align-right {
            text-align: right;
        }

        /* Ajustes específicos para impressão em PDF */
        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }

            .section {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }

            .highlight {
                background-color: #fff;
                border: 1px solid #ddd;
            }

            .cliente-carro-info {
                flex-direction: row;
                justify-content: flex-start;
                align-items: flex-start;
            }

            .cliente-info-column, .carro-info-column {
                width: 50%;
                margin: 0;
                padding: 0 10px;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
<div class="section">
    <h2>Ordem de Serviço</h2>
    <p>CNPJ: 12.345.678/0001-90</p>
</div>

<div class="section cliente-carro-info">
    <div class="cliente-info-column">
        <h2>Dados do Cliente</h2>
        <p><strong>Nome:</strong> {{ $servico->cliente->nome }}</p>
        <p><strong>Email:</strong> {{ $servico->cliente->email }}</p>
        <p><strong>CPF:</strong> {{ formatarCPF($servico->cliente->cpf) }}</p>
        <p><strong>Endereço:</strong> {{ $servico->cliente->endereco }}</p>
        <p><strong>Cidade:</strong> {{ $servico->cliente->cidade }}</p>
        <p><strong>Telefone:</strong> {{ $servico->cliente->telefone }}</p>
        <p><strong>Bairro:</strong> {{ $servico->cliente->bairro }}</p>
    </div>
    <div class="carro-info-column">
        <h2>Dados do Carro</h2>
        <p><strong>Carro:</strong> {{ $dados_completo['nome_carro'] }}</p>
        <p><strong>Marca:</strong> {{ $dados_completo['marca'] }}</p>
        <p><strong>Modelo:</strong> {{ $dados_completo['modelo'] }}</p>
        <p><strong>Ano:</strong> {{ $dados_completo['ano'] }}</p>
        <p><strong>Placa:</strong> {{ $dados_completo['placa'] }}</p>
    </div>
</div>

<div class="section">
    <h2>Produtos do Serviço</h2>
    <table>
        <thead>
        <tr>
            <th>Produto</th>
            <th>Código</th>
            <th>Valor Unitário</th>
            <th>Quantidade</th>
            <th>Valor Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($dados_completo['produtos'] as $produto)
            <tr>
                <td>{{ $produto['produto']['nome'] }}</td>
                <td>{{ $produto['produto']['codigo'] }}</td>
                <td>{{ formatarValor($produto['valor_produto']) }}</td>
                <td>{{ $produto['quantidade'] }}</td>
                <td>{{ formatarValor($produto['valor_produto'] * $produto['quantidade']) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="section highlight">
    <h2>Orçamento</h2>
    <div class="orcamento-info">
        <div><strong>Valor dos Produtos:</strong> {{ formatarValor($dados_completo['valor_total_produtos']) }}</div>
        <div class="align-right"><strong>Valor da Mão de Obra:</strong> {{ formatarValor($dados_completo['valor_mao_de_obra']) }}</div>
        <div><strong>Valor Total do Serviço:</strong> {{ formatarValor($dados_completo['valor_total']) }}</div>
    </div>
</div>
</body>
</html>

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
