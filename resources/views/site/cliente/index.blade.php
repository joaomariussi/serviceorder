@extends('site._partials.basic')

<title>Gerenciamento de Clientes</title>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
@endpush

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

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
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json', // Define o tipo de retorno
                    success: function (response) {
                        console.log(response.message);
                        // Destroi a instância atual do DataTables
                        $('#table-fornecedores').DataTable().destroy();
                        // Recarrega a página após 1 segundo
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        }
    </script>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="{{ asset('js/table-cliente.js') }}"></script>
@endpush


