@extends('app._partials.basic')

@section('title', 'Criar Serviço')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/servico.css') }}">
@endpush

@section('conteudo')
    <div class="main-content">
        <div class="container-servico">
            <h1>Cadastro de Ordem de Serviço</h1>
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form class="form-servico" action="{{ route('app.servico.salvar-servico') }}"
                  method="post" onsubmit="return validarFormulario()">
                @csrf
                <div class="form-group">
                    <label class="label-servico" for="id_cliente">Cliente:</label>
                    <select name="id_cliente" id="id_cliente" class="select-cliente" required>
                        <option disabled selected>Selecione um Cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="servico">
                    <div class="form-group">
                        <label class="label-servico" for="nome_carro">Carro:</label>
                        <input class="input-carro" type="text" id="nome_carro" name="nome_carro" placeholder="Nome do seu Carro" required>
                    </div>

                    <div class="form-group">
                        <label class="label-servico" for="marca">Marca:</label>
                        <select name="marca" id="marca" class="select-marca">
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
                        <select name="modelo" id="modelo" class="select-modelo" required>
                            <option disabled selected>Selecione um modelo de Carro</option>
                            <option value="Hatch">Hatch</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label-servico" for="ano">Ano:</label>
                        <input class="input-ano-carro" step="any" type="number" id="ano" name="ano"
                               placeholder="Ano do seu Carro" required>
                    </div>

                    <div class="form-group">
                        <label class="label-servico" for="placa">Placa:</label>
                        <input class="input_placa" type="text" id="placa" name="placa"
                               placeholder="Placa do seu Carro" required>
                    </div>
                </div>

                <div class="container-buttons">
                    <a href="{{ route('site.home') }}" class="button button-voltar">
                        Voltar
                    </a>
                    <button type="submit" class="button button-avancar">
                        Avançar
                    </button>
                </div>
            </form>
        </div>
    </div>

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
