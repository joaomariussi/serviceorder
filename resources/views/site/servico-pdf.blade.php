<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Detalhes do Serviço</h1>
    </div>
    <div class="section">
        <h2>Dados do Cliente:</h2>
        <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
        <p><strong>Email:</strong> {{ $cliente->email }}</p>
    </div>
    <div class="section">
        <h2>Dados do Carro:</h2>
        <p><strong>Nome:</strong> {{ $dadosServico['nome_carro'] }}</p>
        <p><strong>Marca:</strong> {{ $dadosServico['marca'] }}</p>
        <!-- Adicione outros dados do carro conforme necessário -->
    </div>
{{--    <div class="section">--}}
{{--        <h2>Dados dos Produtos:</h2>--}}
{{--        @foreach ($dadosServico['produtos'] as $produto)--}}
{{--            <p><strong>Nome:</strong> {{ $produto['nome'] }}</p>--}}
{{--            <p><strong>Preço:</strong> R$ {{ $produto['preco'] }}</p>--}}
{{--            <!-- Adicione outros dados do produto conforme necessário -->--}}
{{--        @endforeach--}}
{{--    </div>--}}
    <div class="section">
        <h2>Detalhes do Serviço:</h2>
        <p><strong>Valor Total:</strong> R$ {{ $dadosServico['valor_total'] }}</p>
        <p><strong>Valor da Mão de Obra:</strong>  {{ $dadosServico['valor_mao_obra'] }}</p>
        <!-- Adicione outros detalhes do serviço conforme necessário -->
    </div>
</div>
</body>
</html>
