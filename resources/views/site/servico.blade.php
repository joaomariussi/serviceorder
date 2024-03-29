@extends('site._partials.basico')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/servico.css') }}">

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
        <form class="form-servico" action="{{ route('site.finalizar-servico') }}"
              method="post" onsubmit="return validarFormulario()">
            @csrf
            <div class="form-group">
                <label class="label-servico" for="cliente">Cliente:</label>
                <select name="cliente" id="cliente" required>
                    <option disabled selected>Selecione um Cliente</option>
                    <option value="1">Cliente 1</option>
                </select>
            </div>

            <div class="carro-cliente">
                <div class="form-group">
                    <label class="label-servico" for="nome_carro">Carro:</label>
                    <input type="text" id="nome_carro" name="nome_carro" placeholder="Nome do seu Carro" required>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="marca">Marca:</label>
                    <select name="marca" id="marca">
                        <option disabled selected>Selecione uma marca de Carro</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Ford">Ford</option>
                        <option value="Volkswagen">Volkswagen</option>
                        <option value="Renault">Renault</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Honda">Honda</option>
                        <option value="Nissan">Nissan</option>
                        <option value="Peugeot">Peugeot</option>
                        <option value="Citroën">Citroën</option>
                        <option value="Mitsubishi">Mitsubishi</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                        <option value="BMW">BMW</option>
                        <option value="Audi">Audi</option>
                        <option value="Kia">Kia</option>
                        <option value="Land Rover">Land Rover</option>
                        <option value="Jeep">Jeep</option>
                        <option value="Volvo">Volvo</option>
                        <option value="JAC">JAC</option>
                        <option value="Chery">Chery</option>
                        <option value="Subaru">Subaru</option>
                        <option value="Lifan">Lifan</option>
                        <option value="Troller">Troller</option>
                        <option value="RAM">RAM</option>
                        <option value="Lexus">Lexus</option>
                        <option value="Suzuki">Suzuki</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="modelo">Modelo:</label>
                    <select name="modelo" id="modelo" required>
                        <option disabled selected>Selecione um modelo de Carro</option>
                        <option value="Hatch">Hatch</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="ano">Ano:</label>
                    <input step="any" class="number-servico" type="number" id="ano" name="ano"
                           placeholder="Ano do seu Carro" required>
                </div>

                <div class="form-group">
                    <label class="label-servico" for="placa">Placa:</label>
                    <input type="text" id="placa" name="placa" placeholder="Placa do seu Carro" required>
                </div>
            </div>
            <button type="submit" class="botao-avancar">Avançar</button>
        </form>

        <div class="botoes-navegacao">
            <button type="button" onclick="window.location.href='{{ route('site.home') }}'"
                    class="botao-voltar">Voltar para Home
            </button>
        </div>
    </div>
    </body>

    <script>
        function validarFormulario() {
            var selectCliente = document.getElementById('cliente');
            var selectModelo = document.getElementById('modelo');
            var selectMarca = document.getElementById('marca');

            if (selectCliente.value === 'Selecione um Cliente') {
                alert('Selecione um cliente');
                return false;
            }
            if (selectMarca.value === 'Selecione uma marca de Carro') {
                alert('Selecione uma marca');
                return false;
            }
            if (selectModelo.value === 'Selecione um modelo de Carro') {
                alert('Selecione um modelo');
                return false;
            }
            return true;
        }
    </script>
@endsection
