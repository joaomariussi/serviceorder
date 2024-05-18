@extends('site._partials.basic')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/finalizar-servico.css') }}">
@endpush

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Mask Money -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@section('conteudo')
    @include('site._partials.header')

    <div class="main-content">
        <div class="container-servico">
            <h1>Cadastro de Ordem de Serviço</h1>
            <form class="form-servico" action="{{ route('site.finalizar-servico') }}" method="post" id="form-servico">
                @csrf
                <div class="form-group">
                    <button type="button" id="openModal" class="button-open-modal">Selecionar Produtos</button>
                </div>

                <!-- Div para exibir os produtos selecionados -->
                <div id="produtosSelecionados" class="produtos-selecionados">
                    <!-- Os produtos selecionados serão adicionados aqui -->
                </div>

                <div class="form-group">
                    <label class="label-servico" for="valor_produto">Valor dos Produtos:</label>
                    <input step="any" class="number-servico" type="text" id="valor_produto"
                           name="valor_produto" placeholder="R$ 0,00" required>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="valor_mao_obra">Valor da Mão de Obra:</label>
                    <input step="any" class="number-servico" type="text" id="valor_mao_obra" name="valor_mao_obra"
                           placeholder="R$ 0,00" required>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="valor_total">Valor Total do Serviço:</label>
                    <input step="any" class="number-servico" type="text" id="valor_total"
                           name="valor_total" placeholder="R$ 0,00" required>
                </div>

                <div class="botoes-navegacao">
                    <button type="submit" class="button-finalizar">Finalizar Serviço</button>
                </div>

                <div class="botoes-navegacao">
                    <button type="button" onclick="window.location.href='{{ route('site.servico') }}'"
                            class="button-voltar">Voltar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para selecionar produtos -->
    <div id="myModal" class="modal-servico">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <select class="select-servico" id="produtos-list"></select>
            <input class="quantidade" type="number" id="quantidade" placeholder="Quantidade" min="1">
            <button id="adicionarProduto" class="button-add-modal">Adicionar</button>
            <button class="button-cancelar" id="cancelar">Cancelar</button>
        </div>
    </div>

    <script>
        // Função para fechar o modal
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
@endsection

@push('scripts')
    <script src={{ asset('js/scripts.js') }}></script>
@endpush
