@extends('site._partials.basic')

<title>Gerenciamento de Clientes</title>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
@endpush

@section('conteudo')
    @include('site._partials.header')
    <div class="conteudo-pagina">

        <div class="menu-cliente">

            <table id="clientes" class="display" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ substr($cliente->cpf, 0, 3) }}.{{ substr($cliente->cpf, 3, 3) }}.
                            {{ substr($cliente->cpf, 6, 3) }}-{{ substr($cliente->cpf, -2) }}</td>
                        <td>{{ substr($cliente->telefone, 0, 2) }} {{ substr($cliente->telefone, 2, 5) }}
                            -{{ substr($cliente->telefone, -4) }}</td>
                        <td>
                            <form class="form-clientes" id="form-editar-fornecedor-{{ $cliente->id }}"
                                  {{--                                  action="{{ route('app.fornecedor.editar', ['id' => $cliente->id]) }}"--}}
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                                <button type="button" class="button-edit"
                                        onclick="">Editar
                                </button>
                                <button type="button" class="button-delete"
                                        onclick="excluirCliente('{{ $cliente->id }}')">Excluir
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
        function excluirCliente(id) {
            if (confirm('Deseja realmente excluir este cliente?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/cliente/' + id,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // Redireciona para a página após a exclusão bem-sucedida
                        window.location.href = '{{ route("site.cliente.index") }}';
                    },
                    error: function (xhr, status, error) {
                        // Redireciona para a página de listagem com a mensagem de erro
                        window.location.href = '{{ route("site.cliente.index") }}';
                    }
                });
            }
        }

        $(document).ready(function(){
            // Espera a página carregar completamente
            setTimeout(function(){
                // Verifica se há uma mensagem flash
                if($('.alert').length > 0){
                    // Mostra a mensagem flash
                    $('.alert').slideDown();
                    // Define um tempo para esconder a mensagem flash após 5 segundos
                    setTimeout(function(){
                        $('.alert').slideUp();
                    }, 3000);
                }
            }, 1000); // Aguarda 1 segundo antes de verificar a existência da mensagem flash
        });
    </script>


@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="{{ asset('js/table-cliente.js') }}"></script>
@endpush
