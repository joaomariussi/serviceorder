@extends('app._partials.basic')

@section('title', 'Visualizar Serviço'. $servico->id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-servico.css') }}">
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <a href="{{ route('app.servico.index') }}" class="botao-voltar">Voltar</a>

        <div class="informacoes">
            <div class="info-servico coluna-informacoes">
                <h3>Informações do Pedido</h3>
                <p><strong>ID do Pedido:</strong> {{ $servico->id }}</p>
                <p><strong>Pedido criado em:</strong> {{ $servico->created_at->format('d/m/Y H:i') }}</p>
                <a class="button-imprimir" href="{{ route('app.servico.exportar-pdf', ['id' => $servico->id]) }}">
                    Imprimir Pedido
                </a>

            </div>

            <div class="resumo-servico">
                <div class="card">
                    <h4>Total do Pedido</h4>
                    <p>R$ {{ number_format($servico->valor_total, 2, ',', '.') }}</p>
                </div>
                <div class="card">
                    <h4>Quantidade de Itens</h4>
                    <p>{{ $quantidade_total }}</p>
                </div>
            </div>
        </div>

        <div class="detalhes-servico">
            <div class="coluna-esquerda">
                <h3>Dados do Cliente</h3>
                <p><strong>Nome:</strong> {{ $servico->cliente->nome }}</p>
                <p><strong>CPF:</strong> <script>document.write(formatarCpf('{{ $servico->cliente->cpf }}'))</script></p>
                <p><strong>Email:</strong> {{ $servico->cliente->email }}</p>
                <p><strong>Telefone:</strong> <script>document.write(formatarTelefone('{{ $servico->cliente->telefone }}'))</script></p>
            </div>

            <div class="coluna-direita">
                <h3>Dados da Entrega</h3>
                <p><strong>CEP:</strong> <script>document.write(formatarCep('{{ $servico->cliente->cep }}'))</script></p>
                <p><strong>Cidade:</strong> {{ $servico->cliente->cidade }}</p>
                <p><strong>Estado:</strong> {{ $servico->cliente->estado }}</p>
                <p><strong>Endereço:</strong> {{ $servico->cliente->endereco }}</p>
            </div>
        </div>

        <div class="produtos-servico">
            <h3 class="title-produtos-servico">Produtos</h3>
            <table>
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Código Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($servico_produtos as $servico_produto)
                    <tr>
                        <td>{{ $servico_produto->produto->nome }}</td>
                        <td>{{ $servico_produto->produto->codigo }}</td>
                        <td>{{ $servico_produto->quantidade }}</td>
                        <td>R$ {{ number_format($servico_produto->produto->preco, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="{{ asset('js/scripts.js') }}"></script>
