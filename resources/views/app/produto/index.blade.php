@extends('app._partials.basic')

@section('title', 'Produtos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/produto.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/table-produtos.js') }}"></script>
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="title-produtos">
            <h1 class="title-h1">Produtos Cadastrados</h1>
        </div>
        <div class="menu-servico">
            <table id="produtos" class="display" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->codigo }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->quantidade }} un</td>
                        <td>
                            <form class="form-clientes" id="form-editar-fornecedor-{{ $produto->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="cliente_id" value="{{ $produto->id }}">
                                <button type="button" class="button-edit"
                                        onclick="">Editar
                                </button>
                                <button type="button" class="button-delete"
                                        onclick="excluirProduto('{{ $produto->id }}')">Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function excluirProduto(id) {
            if (confirm('Deseja realmente excluir esse produto?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/produtos/excluir/' + id,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // Redireciona para a página após a exclusão bem-sucedida
                        window.location.href = '{{ route("app.produto.index") }}';
                    },
                    error: function (xhr, status, error) {
                        // Redireciona para a página de listagem com a mensagem de erro
                        window.location.href = '{{ route("app.produto.index") }}';
                    }
                });
            }
        }

        $(document).ready(function () {
            // Espera a página carregar completamente
            setTimeout(function () {
                // Verifica se há uma mensagem flash
                if ($('.alert').length > 0) {
                    // Mostra a mensagem flash
                    $('.alert').slideDown();
                    // Define um tempo para esconder a mensagem flash após 5 segundos
                    setTimeout(function () {
                        $('.alert').slideUp();
                    }, 3000);
                }
            }, 1000); // Aguarda 1 segundo antes de verificar a existência da mensagem flash
        });
    </script>
@endsection


