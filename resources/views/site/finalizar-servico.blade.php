@extends('site._partials.basico')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/finalizar-servico.css') }}">

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

            <div class="form-group">
                <label class="label-servico" for="quantidade">Valor da Mão de Obra:</label>
                <input step="any" class="number-servico" type="number" id="quantidade" name="quantidade"
                       placeholder="Quantidade" required>
            </div>

            <div class="form-group">
                <label class="label-servico" for="valor_pecas">Valor Total:</label>
                <input step="any" class="number-servico" type="number" id="valor_total" name="valor_total"
                       placeholder="Valor total do Serviço" required>
            </div>

            <div class="form-group">
                <label class="label-servico" for="valor_mao_obra">Valor da Mão de Obra:</label>
                <input step="any" class="number-servico" type="number" id="valor_mao_obra" name="valor_mao_obra"
                       placeholder="Valor da Mão de Obra" required>
            </div>

            <div class="form-group">
                <label class="label-servico" for="valor_pecas">Valor Total:</label>
                <input step="any" class="number-servico" type="number" id="valor_total" name="valor_total"
                       placeholder="Valor total do Serviço" required>
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

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Selecionar Produtos</h2>
        </div>
    </div>

    <script src={{ asset('js/scripts.js') }}></script>
@endsection
