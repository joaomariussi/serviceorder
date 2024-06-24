@extends('app._partials.basic')

@section('title', 'Clientes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/table-cliente.js') }}"></script>
@endpush

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="title-cliente">
            <h1 class="title-h1">Clientes</h1>
        </div>
        <div class="menu-cliente">
            <div class="conteudo-pagina">
                <table id="clientes" class="display">
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
                            <td>{{ substr($cliente->cpf, 0, 3) }}.{{ substr($cliente->cpf, 3, 3) }}.{{ substr($cliente->cpf, 6, 3) }}-{{ substr($cliente->cpf, -2) }}</td>
                            <td>{{ substr($cliente->telefone, 0, 2) }} {{ substr($cliente->telefone, 2, 5) }}-{{ substr($cliente->telefone, -4) }}</td>
                            <td>
                                <form class="form-clientes" id="form-editar-cliente-{{ $cliente->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
                                    <a href="{{ route('app.cliente.visualizar', $cliente->id) }}" type="button"
                                       class="button-view" onclick="">
                                        Visualizar
                                    </a>
                                    <button type="button" class="button-delete"
                                            onclick="excluirCliente('{{ $cliente->id }}')">
                                        Excluir
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
    </div>

    <script>
        function excluirCliente(id) {
            if (confirm('Deseja realmente excluir este cliente?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/clientes/excluir/' + id,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location.href = '{{ route("app.cliente") }}';
                    },
                    error: function (xhr, status, error) {
                        window.location.href = '{{ route("app.cliente") }}';
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
