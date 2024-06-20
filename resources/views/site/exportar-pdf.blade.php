<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .highlight {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .align-right {
            text-align: right;
        }

        .image-logo img {
            max-width: 100px;
        }
    </style>
</head>
<body>
<div class="section">
    <h2>Service Order</h2>
    <p>CNPJ: 12.345.678/0001-90</p>
</div>

<div class="section">
    <h2>Dados do Cliente</h2>
    <div class="cliente-info">
        <div class="cliente-info-column">
            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>CPF:</strong> {{ formatarCPF($cliente->cpf) }}</p>
            <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
            <p><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
        </div>
        <div class="cliente-info-column">
            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            <p><strong>Bairro:</strong> {{ $cliente->bairro }}</p>
        </div>
    </div>
</div>

<div class="section">
    <h2>Dados do Carro</h2>
    <p><strong>Carro:</strong> {{ $dados_completo['nome_carro'] }}</p>
    <p><strong>Marca:</strong> {{ $dados_completo['marca'] }}</p>
    <p><strong>Modelo:</strong> {{ $dados_completo['modelo'] }}</p>
    <p><strong>Ano:</strong> {{ $dados_completo['ano'] }}</p>
    <p><strong>Placa:</strong> {{ $dados_completo['placa'] }}</p>
</div>

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

<div class="section highlight">
    <h2>Orçamento</h2>
    <div class="orcamento-info">
        <div><strong>Valor dos Produtos:</strong> {{ $dados_completo['valor_produto'] }}</div>
        <div class="align-right"><strong>Valor da Mão de Obra:</strong> {{ $dados_completo['valor_mao_de_obra'] }}</div>
        <div><strong>Valor Total do Serviço:</strong> R$ {{ $dados_completo['valor_total'] }}</div>
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
