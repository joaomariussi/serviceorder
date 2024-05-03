@extends('site._partials.basic')

<title>Gerenciamento de Clientes</title>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
@endpush

@section('conteudo')
    @include('site._partials.header')
    <div class="conteudo-pagina">

        <div class="titulo-cliente">
            <h2>Clientes</h2>
        </div>

        <div class="menu-cliente">

            <table id="clientes" class="display" style="width:100%">
                <thead>
                <tr>
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
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->cpf }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>
                            <form class="form-clientes" id="form-editar-fornecedor-{{ $cliente->id }}"
{{--                                  action="{{ route('app.fornecedor.editar', ['id' => $cliente->id]) }}"--}}
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="fornecedor_id" value="{{ $cliente->id }}">
                                <button type="button" class="button-edit"
                                        onclick="openModalForEdit('{{ $cliente->nome }}', '{{ $cliente->site }}',
                                            '{{ $cliente->uf }}',
                                        '{{ $cliente->email }}')">Editar
                                </button>
                                <button type="button" class="button-delete"
                                        onclick="excluirFornecedor('{{ $cliente->id }}')">Excluir
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

{{--    <!-- Modal -->--}}
{{--    <div id="modal-fornecedor" class="modal-fornecedor">--}}
{{--        <div class="modal-content">--}}
{{--            <span class="close-modal" onclick="closeModal()">&times;</span>--}}
{{--            <div class="form-group">--}}
{{--                <label for="nome" class="label-nome">Nome</label>--}}
{{--                <input type="text" class="nome-modal" id="editNome" name="nome" placeholder="Nome">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="site" class="label-site">Site</label>--}}
{{--                <input type="text" class="site-modal" id="editSite" name="site" placeholder="Site">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="uf" class="label-uf">UF</label>--}}
{{--                <input type="text" class="uf-modal" id="editUF" name="uf" placeholder="UF">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="email" class="label-email">Email</label>--}}
{{--                <input type="text" class="email-modal" id="editEmail" name="email" placeholder="Email">--}}
{{--            </div>--}}

{{--            <button type="button" class="button-save-modal" onclick="saveChanges()">Salvar</button>--}}
{{--            <button type="button" class="button-close-modal" onclick="closeModal()">Cancelar</button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        function openModalForEdit(nome, site, uf, email) {--}}
{{--            document.getElementById('editNome').value = nome;--}}
{{--            document.getElementById('editSite').value = site;--}}
{{--            document.getElementById('editUF').value = uf;--}}
{{--            document.getElementById('editEmail').value = email;--}}
{{--            document.getElementById('modal-fornecedor').style.display = 'block';--}}
{{--        }--}}


{{--        function closeModal() {--}}
{{--            document.getElementById('modal-fornecedor').style.display = 'none';--}}
{{--        }--}}

{{--        function saveChanges() {--}}
{{--            var id = document.getElementsByName('fornecedor_id')[0].value;--}}
{{--            var nome = document.getElementById('editNome').value;--}}
{{--            var site = document.getElementById('editSite').value;--}}
{{--            var uf = document.getElementById('editUF').value;--}}
{{--            var email = document.getElementById('editEmail').value;--}}

{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: '/fornecedor/editar/' + id,--}}
{{--                data: {--}}
{{--                    id: id,--}}
{{--                    nome: nome,--}}
{{--                    site: site,--}}
{{--                    uf: uf,--}}
{{--                    email: email,--}}
{{--                    _token: '{{ csrf_token() }}'--}}
{{--                },--}}
{{--                dataType: 'json', // Define o tipo de retorno--}}
{{--                success: function (response) {--}}
{{--                    console.log(response.message);--}}
{{--                    // Recarrega a página após 1 segundo--}}
{{--                    setTimeout(function () {--}}
{{--                        location.reload();--}}
{{--                    }, 1000);--}}
{{--                    // Fecha o modal.--}}
{{--                    closeModal();--}}
{{--                },--}}
{{--                error: function (xhr, status, error) {--}}
{{--                    console.error(error);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        function excluirFornecedor(id) {--}}
{{--            if (confirm('Deseja realmente excluir este fornecedor?')) {--}}
{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: '/fornecedor/excluir/' + id,--}}
{{--                    data: {--}}
{{--                        id: id,--}}
{{--                        _token: '{{ csrf_token() }}'--}}
{{--                    },--}}
{{--                    dataType: 'json', // Define o tipo de retorno--}}
{{--                    success: function (response) {--}}
{{--                        console.log(response.message);--}}
{{--                        // Destroi a instância atual do DataTables--}}
{{--                        $('#table-fornecedores').DataTable().destroy();--}}
{{--                        // Recarrega a página após 1 segundo--}}
{{--                        setTimeout(function () {--}}
{{--                            location.reload();--}}
{{--                        }, 1000);--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.error(error);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="{{ asset('js/table-cliente.js') }}"></script>
    <script>
        // Adicione seu script JavaScript aqui
    </script>
@endpush


