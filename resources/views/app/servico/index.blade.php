@extends('app._partials.basic')

@section('title', 'Visualizar Serviços')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/visualizar-servicos.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/table-servicos.js') }}"></script>
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="title-cliente">
            <h1 class="title-h1">Serviços realizados</h1>
        </div>
        <div class="menu-servico">
            <div class="conteudo-pagina">
                <table id="pedidos" class="display">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Quantidade de itens</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Data do Pedido</th>
                        <th scope="col">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($servicos as $servico)
                        <tr>
                            <td>{{ $servico->id }}</td>
                            <td>{{ $servico->cliente->nome }}</td>
                            <td>{{ substr($servico->cliente->cpf, 0, 3) }}.{{ substr($servico->cliente->cpf, 3, 3) }}.{{ substr($servico->cliente->cpf, 6, 3) }}-{{ substr($servico->cliente->cpf, -2) }}</td>
                            <td>{{ $servico->quantidade_total }} un</td>
                            <td>R$ {{ number_format($servico->valor_total, 2, ',', '.') }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($servico->created_at)) }}</td>
                            <td>
                                <form class="form-clientes" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="cliente_id" value="{{ $servico->id }}">
                                    <div class="button-container">
                                        <a href="{{ route('app.servico.visualizar-servico', $servico->id) }}" class="button-view">Visualizar</a>
                                        <button type="button" class="button-delete" onclick="excluirServico('{{ $servico->id }}')">Excluir</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function excluirServico(id) {
            if (confirm('Deseja realmente excluir este serviço?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/servico/excluir/' + id,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location.href = '{{ route("app.servico.index") }}';
                    },
                    error: function (xhr, status, error) {
                        window.location.href = '{{ route("app.servico.index") }}';
                    }
                });
            }
        }

        $(document).ready(function(){
            setTimeout(function(){
                if($('.alert').length > 0){
                    $('.alert').slideDown();
                    setTimeout(function(){
                        $('.alert').slideUp();
                    }, 3000);
                }
            }, 1000);
        });
    </script>
@endsection
