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
        var quantidade = quantidadeInput.value;

        // Verificar se a quantidade foi selecionada
        if (quantidade === '') {
            alert('Selecione uma quantidade para o produto.');
            return; // Sair da função sem adicionar o produto
        }

        // Obter o preço
        var selectedProductPrice = parseFloat(select.options[select.selectedIndex].dataset.preco);

        // Verificar se o produto já foi adicionado
        var produtoExistente = produtosSelecionados.find(function (produto) {
            return produto.id === selectedProductId;
        });

        // Se o produto já foi adicionado, apenas atualize a quantidade
        if (produtoExistente) {
            produtoExistente.quantidade += parseInt(quantidade);
        } else {
            // Adicionar o produto à lista de produtos selecionados
            produtosSelecionados.push({
                id: selectedProductId,
                nome: selectedProductName,
                quantidade: parseInt(quantidade),
                preco: selectedProductPrice
            });
        }

        // Atualizar a lista de produtos na view
        updateProdutoList();

        // Fechar o modal
        closeModal();
    });

    // Função para abrir o modal
    function openModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        // Fazer uma solicitação AJAX para obter os produtos
        fetch('/produtos')
            .then(response => response.json())
            .then(data => {
                // Limpar o select
                var select = document.getElementById('produtos-list');
                select.innerHTML = '';

                // Preencher o select com os produtos retornados
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
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    // Função para atualizar a lista de produtos na view
    // Função para atualizar a lista de produtos na view
    function updateProdutoList() {
        // Limpar a lista de produtos na view
        var produtosSelecionadosDiv = document.getElementById('produtosSelecionados');
        produtosSelecionadosDiv.innerHTML = '';

        // Verificar se há produtos selecionados
        if (produtosSelecionados.length === 0) {
            // Se não houver produtos, exibir mensagem
            var mensagemDiv = document.createElement('div');
            mensagemDiv.textContent = 'Nenhum produto selecionado';
            produtosSelecionadosDiv.appendChild(mensagemDiv);
        } else {
            // Iterar sobre os produtos selecionados e adicioná-los à lista na view
            produtosSelecionados.forEach(function (produto, index) {
                var produtoDiv = document.createElement('div');
                produtoDiv.textContent = produto.nome;

                // Verificar se é o primeiro produto ou não
                if (index > 0) {
                    produtoDiv.style.marginTop = '5px'; // Adiciona o espaçamento apenas para os produtos além do primeiro
                }

                // Verificar se a quantidade foi selecionada
                if (produto.quantidade > 0) {
                    // Calcular o preço total do produto (preço x quantidade)
                    var precoTotal = produto.preco * produto.quantidade;
                    produtoDiv.textContent += ' - Quantidade: ' + produto.quantidade + ' - Preço Total: R$ ' + precoTotal.toFixed(2);
                } else {
                    // Se a quantidade não foi selecionada, exibir uma mensagem indicando o problema
                    produtoDiv.textContent += ' - Selecione uma quantidade';
                }

                produtosSelecionadosDiv.appendChild(produtoDiv);

                // Adicionar um botão para remover o produto da lista
                var removerButton = document.createElement('button');
                removerButton.textContent = 'Remover';
                removerButton.classList.add('botao-remover');
                removerButton.dataset.id = produto.id; // Adiciona o ID do produto como um atributo personalizado
                removerButton.addEventListener('click', function () {
                    // Obter o ID do produto a ser removido
                    var id = this.dataset.id;

                    // Remover o produto da lista de produtos selecionados
                    produtosSelecionados = produtosSelecionados.filter(function (produto) {
                        return produto.id !== id;
                    });

                    // Atualizar a lista de produtos na view
                    updateProdutoList();

                    // Atualizar o valor total na view
                    updateValorTotal();
                });

                produtoDiv.appendChild(removerButton);
            });
        }

        // Atualizar o valor total na view
        updateValorTotal();
    }

    // Função para atualizar o valor total na view
    function updateValorTotal() {
        var valorTotalInput = document.getElementById('valor_total');
        var valorTotal = 0;

        // Calcular o valor total com base nos produtos selecionados
        produtosSelecionados.forEach(function (produto) {
            valorTotal += produto.preco * produto.quantidade;
        });

        // Atualizar o valor total no input
        valorTotalInput.value = valorTotal.toFixed(2);
    }

    // Máscara para o input de valor da mão de obra
    $('#valor_mao_obra').maskMoney({
        prefix: 'R$ ',    // Prefixo do cifrão
        allowNegative: false,  // Não permite valores negativos
        thousands: '.',  // Separador de milhares
        decimal: ',',    // Separador decimal
        affixesStay: true // Mantém o cifrão na frente do valor mesmo quando estiver vazio
    });

    // Máscara para o input de valor total
    $('#valor_total').maskMoney({
        prefix: 'R$ ',    // Prefixo do cifrão
        allowNegative: false,  // Não permite valores negativos
        thousands: '.',  // Separador de milhares
        decimal: ',',    // Separador decimal
        affixesStay: true // Mantém o cifrão na frente do valor mesmo quando estiver vazio
    });
});
