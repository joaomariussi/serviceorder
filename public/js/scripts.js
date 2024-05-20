document.addEventListener('DOMContentLoaded', function () {
    // Armazenar os produtos selecionados
    var produtosSelecionados = [];

    // Ouvinte de evento para o botão "Cancelar"
    var cancelarButton = document.getElementById('cancelar');
    cancelarButton.addEventListener('click', function () {
        closeModal();
    });

    // Ouvinte de evento para abrir o modal quando o botão for clicado
    var openModalButton = document.getElementById('openModal');
    openModalButton.addEventListener('click', function () {
        openModal();
    });

    // Ouvinte de evento para o botão "Adicionar"
    var adicionarButton = document.getElementById('adicionarProduto');
    adicionarButton.addEventListener('click', function () {
        // Obter o produto selecionado
        var select = document.getElementById('produtos-list');
        var selectedProductId = select.value;
        var selectedProductName = select.options[select.selectedIndex].text;

        // Obter a quantidade
        var quantidadeInput = document.getElementById('quantidade');
        var quantidade = parseInt(quantidadeInput.value);

        // Verificar se a quantidade foi selecionada
        if (quantidade === '' || quantidade <= 0) {
            alert('Selecione uma quantidade válida para o produto.');
            return; // Sair da função sem adicionar o produto
        }

        // Obter o preço
        var selectedProductPrice = parseFloat(select.options[select.selectedIndex].dataset.preco);

        // Verificar se o produto já foi selecionado
        var produtoExistente = produtosSelecionados.find(produto => produto.id === selectedProductId);
        if (produtoExistente) {
            // Atualizar a quantidade e o valor total do produto existente
            produtoExistente.quantidade += quantidade;
            produtoExistente.preco = selectedProductPrice; // Atualiza o preço caso ele tenha mudado
        } else {
            // Criar um objeto representando o novo produto selecionado
            var produto = {
                id: selectedProductId,
                nome: selectedProductName,
                quantidade: quantidade,
                preco: selectedProductPrice
            };
            // Adiciona o produto à lista de produtos selecionados
            produtosSelecionados.push(produto);
        }

        // Atualiza a lista de produtos na view
        updateProdutoList();

        // Fecha o modal
        closeModal();

        // Atualiza o valor total na view
        updateValorTotal();

        // Limpa o campo de quantidade para que o usuário possa selecionar outra quantidade
        quantidadeInput.value = '';

        // Atualiza ou adiciona o produto ao formulário
        updateProdutoInForm();
    });

    // Função para adicionar ou atualizar o produto no formulário
    function updateProdutoInForm() {
        var form = document.getElementById('form-servico');
        // Limpa todos os inputs ocultos de produtos existentes
        var inputs = form.querySelectorAll('input[name^="produtos["]');
        inputs.forEach(input => input.remove());

        // Adiciona os produtos atualizados ao formulário
        produtosSelecionados.forEach(produto => {
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'produtos[' + produto.id + '][id_produto]';
            inputId.value = produto.id;
            form.appendChild(inputId);

            var inputValorProduto = document.createElement('input');
            inputValorProduto.type = 'hidden';
            inputValorProduto.name = 'produtos[' + produto.id + '][valor_produto]';
            inputValorProduto.value = produto.preco;
            form.appendChild(inputValorProduto);

            var inputQuantidade = document.createElement('input');
            inputQuantidade.type = 'hidden';
            inputQuantidade.name = 'produtos[' + produto.id + '][quantidade]';
            inputQuantidade.value = produto.quantidade;
            form.appendChild(inputQuantidade);
        });
    }

    // Função para abrir o modal
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        // Faz uma solicitação AJAX para obter os produtos
        fetch('/produtos')
            .then(response => response.json())
            .then(data => {
                // Limpar o select
                var select = document.getElementById('produtos-list');
                select.innerHTML = '';

                // Preenche o select com os produtos retornados
                data.forEach(function (produto) {
                    var option = document.createElement('option');
                    option.text = produto.nome; // Supondo que 'nome' seja o campo que contém o nome do produto
                    option.value = produto.id; // Supondo que 'id' seja o campo que contém o ID do produto
                    option.dataset.preco = produto.preco; // Adiciona o preço como um atributo personalizado
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erro ao obter os produtos:', error);
            });
    }

    // Função para fechar o modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Função para atualizar a lista de produtos na view
    function updateProdutoList() {
        var produtosSelecionadosDiv = document.getElementById('produtosSelecionados');
        produtosSelecionadosDiv.innerHTML = '';

        if (produtosSelecionados.length === 0) {
            var mensagemDiv = document.createElement('div');
            mensagemDiv.textContent = 'Nenhum produto selecionado';
            produtosSelecionadosDiv.appendChild(mensagemDiv);
        } else {
            produtosSelecionados.forEach(function (produto) {
                var produtoDiv = document.createElement('div');
                produtoDiv.textContent = produto.nome + ' - Quantidade: ' + produto.quantidade + ' - Preço Total: R$ ' + (produto.preco * produto.quantidade).toFixed(2);
                produtosSelecionadosDiv.appendChild(produtoDiv);

                var removerButton = document.createElement('button');
                removerButton.textContent = 'Remover';
                removerButton.classList.add('button-remover-produto');
                removerButton.dataset.id = produto.id;
                removerButton.addEventListener('click', function () {
                    var id = this.dataset.id;
                    produtosSelecionados = produtosSelecionados.filter(function (produto) {
                        return produto.id !== id;
                    });
                    updateProdutoList();
                    updateValorTotal();
                    updateProdutoInForm();
                });

                produtoDiv.appendChild(removerButton);
            });
        }

        updateValorTotal();
    }

    // Função para atualizar o valor total na view
    function updateValorTotal() {
        var valorProdutosInput = document.getElementById('valor_produto');
        var valorTotalProdutos = 0;

        produtosSelecionados.forEach(function (produto) {
            valorTotalProdutos += produto.preco * produto.quantidade;
        });

        valorProdutosInput.value = 'R$ ' + valorTotalProdutos.toFixed(2);

        var valorMaoObraInput = document.getElementById('valor_mao_obra');
        var valorMaoObra = parseFloat(valorMaoObraInput.value.replace('R$ ', '').replace('.', '').replace(',', '.'));

        if (!isNaN(valorMaoObra)) {
            var valorTotal = valorTotalProdutos + valorMaoObra;
            var valorTotalForm = document.getElementById('valor_total');
            valorTotalForm.value = 'R$ ' + valorTotal.toFixed(2);
        }

        valorMaoObraInput.addEventListener('blur', function () {
            updateValorTotal();
        });
    }

    $('#valor_mao_obra').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: true
    });

    $('#valor_produto').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: true
    });

    $('#valor_total').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: true
    });
});
