@extends('site._partials.basic')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/finalizar-servico.css') }}">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Mask Money -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@section('conteudo')
    <nav>
        <a href="{{ route('site.home') }}">Início</a>
        <a href="{{ route('site.servico') }}">Serviços</a>
        <a href="#">Contato</a>
        <a href="{{ route('logout') }}">Sair</a>
    </nav>
    <body>
    <div class="container-servico">
        <h1>Cadastro de Ordem de Serviço</h1>
        <form class="form-servico" action="{{ route('site.finalizar-servico') }}" method="post" id="form-servico">
            @csrf
            <div class="form-group">
                <button type="button" id="openModal">Selecionar Produtos</button>
            </div>

            <!-- Div para exibir os produtos selecionados -->
            <div id="produtosSelecionados" class="produtos-selecionados">
                <!-- Os produtos selecionados serão adicionados aqui -->
            </div>

            <div class="form-group">
                <label class="label-servico" for="valor_mao_obra">Valor da Mão de Obra:</label>
                <input step="any" class="number-servico" type="text" id="valor_mao_obra" name="valor_mao_obra"
                       placeholder="R$ 0,00" required>
            </div>

            <div class="form-group">
                <label class="label-servico" for="valor_total">Valor Total:</label>
                <input step="any" class="number-servico" type="text" id="valor_total"
                       name="valor_total" data-thousands="." data-decimal="," placeholder="R$ 0,00" required>
            </div>

            <button type="submit" class="botao-finalizar">Finalizar Serviço</button>
        </form>

        <div class="botoes-navegacao">
            <button type="button" onclick="window.location.href='{{ route('site.servico') }}'"
                    class="botao-voltar">Voltar
            </button>
        </div>
    </div>
    </body>

    <!-- Modal para selecionar produtos -->
    <div id="myModal" class="modal-servico">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <select class="select-servico" id="produtos-list"></select>
            <input class="label-script" type="number" id="quantidade" placeholder="Quantidade" min="1">
            <button id="adicionarProduto">Adicionar</button>
            <button class="button-cancelar" id="cancelar">Cancelar</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('js/scripts.js') }}></script>
@endpush
