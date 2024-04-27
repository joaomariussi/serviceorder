<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        h1, h2 {
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-heading {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .cliente-info {
            display: flex;
            justify-content: space-between;
        }
        .cliente-info-column {
            width: 48%;
        }
        .carro-info {
            display: flex;
            justify-content: space-between;
        }
        .carro-info-column {
            width: 48%;
        }
        .destacado {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            overflow: hidden;
        }
        .destacado-label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }
        .destacado-right {
            display: inline-block;
            float: right; /* Adicionado para alinhar os valores à direita */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header img {
            max-width: 150px;
        }
        @media print {
            body {
                margin: 0;
            }
            .container {
                margin: 0 auto;
                box-shadow: none;
            }
            .section-heading {
                background-color: #f2f2f2;
                padding: 5px 0;
            }
            table {
                border: 1px solid #ddd;
            }
            th, td {
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Cabeçalho com o nome da mecânica e a logo -->
    <div class="header">
        <div>
            <h2>Service Order</h2>
            <p>CNPJ: 12.345.678/0001-90</p>
        </div>
        <img src="images/mecanico.png">
    </div>

    <div class="section">
        <h2 class="section-heading">Dados do Cliente</h2>
        <div class="cliente-info">
            <div class="cliente-info-column">
                <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
                <p><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
                <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            </div>
            <div class="cliente-info-column">
                <p><strong>Bairro:</strong> {{ $cliente->bairro }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>
                <p><strong>CPF:</strong> {{ formatarCPF($cliente->cpf) }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-heading">Dados do Carro</h2>
        <div class="carro-info">
            <div class="carro-info-column">
                <p><strong>Nome do Carro:</strong> {{ $dadosServico['nome_carro'] }}</p>
                <p><strong>Marca:</strong> {{ $dadosServico['marca'] }}</p>
                <p><strong>Modelo:</strong> {{ $dadosServico['modelo'] }}</p>
            </div>
            <div class="carro-info-column">
                <p><strong>Ano:</strong> {{ $dadosServico['ano'] }}</p>
                <p><strong>Placa:</strong> {{ $dadosServico['placa'] }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-heading">Produtos</h2>
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

    <!-- Div destacada para o orçamento -->
    <div class="destacado">
        <h2>Orçamento</h2>
        <div>
            <div class="destacado-label">Valor dos Produtos:</div>
            <div class="destacado-right"> {{ $dadosServico['valor_produto'] }}</div>
        </div>
        <div>
            <div class="destacado-label">Valor da Mão de Obra:</div>
            <div class="destacado-right"> {{ $dadosServico['valor_mao_obra'] }}</div>
        </div>
        <div>
            <div class="destacado-label">Valor Total do Serviço:</div>
            <div class="destacado-right">R$ {{ $dadosServico['valor_total'] }}</div>
        </div>
    </div>

</div>
</body>
</html>

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
