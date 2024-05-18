<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ProdutosModel;
use App\Models\ServicoModel;
use App\Models\ServicosProdutosModel;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Throwable;

class ServicoController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::all();
            return view('site.servico', compact('clientes'));
        } catch (Throwable $e) {
            return view('site.servico')->with('error', 'Erro ao carregar a página de serviço: ' . $e->getMessage());
        }
    }

    public function criarServico(Request $request)
    {
        try {
            $clientes = ClientesModel::all(); // Busca os clientes novamente
            $request->session()->put('dados_servico', $request->all());

            $dados_servico = $request->session()->get('dados_servico');

            return view('site.finalizar-servico', compact('dados_servico', 'clientes'));

        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Erro ao criar serviço: ' . $e->getMessage());
        }
    }

    public function finalizarServico(Request $request)
    {
        try {

            $clientes = ClientesModel::all(); // Busca os clientes novamente

            if (!$request->session()->has('dados_servico')) {
                return view('site.servico')->with('error',
                    'Erro ao finalizar serviço: Dados do serviço não encontrados na sessão.');
            }

            // Recupera os dados do serviço da sessão
            $dados_servico = $request->session()->get('dados_servico');

            // Recupera os dados do formulário
            $dados_view = $request->all();

            // Combina os dados do serviço com os dados do formulário
            $dados_completo = array_merge($dados_servico, $dados_view);

            // Remove o prefixo "R$ " do valor total do serviço antes de salvar
            $dados_completo['valor_total'] = str_replace('R$ ', '', $dados_completo['valor_total']);

            // Remover o prefixo "R$ " do valor da mão de obra antes de salvar
            $valor_mao_obra = str_replace('R$ ', '', $dados_completo['valor_mao_obra']);
            // Remover possíveis separadores de milhares (pontos)
            $valor_mao_obra = str_replace('.', '', $valor_mao_obra);
            // Substituir a vírgula decimal por ponto
            $valor_mao_obra = str_replace(',', '.', $valor_mao_obra);

            // Salva o serviço
            $servico = new ServicoModel();
            $servico->id_cliente = $dados_completo['id_cliente'] ?? null;
            $servico->nome_carro = $dados_completo['nome_carro'] ?? null;
            $servico->marca = $dados_completo['marca'] ?? null;
            $servico->modelo = $dados_completo['modelo'] ?? null;
            $servico->ano = $dados_completo['ano'] ?? null;
            $servico->placa = $dados_completo['placa'] ?? null;
            $servico->valor_mao_obra = (float) $valor_mao_obra;
            $servico->valor_total = $dados_completo['valor_total'];
            $servico->save();

            foreach ($dados_completo['produtos'] as $produto) {
                $servicoProduto = new ServicosProdutosModel();
                $servicoProduto->id_servico = $servico->id;
                $servicoProduto->id_cliente = $dados_completo['id_cliente'];
                $servicoProduto->id_produto = $produto['id_produto'];

                // Remover o prefixo "R$ " do valor do produto antes de salvar
                $valor_produto = str_replace('R$ ', '', $produto['valor_produto']);
                // Remover possíveis separadores de milhares (pontos)
                $valor_produto = str_replace('.', '', $valor_produto);
                // Substituir a vírgula decimal por ponto
                $valor_produto = str_replace(',', '.', $valor_produto);
                // Converter para número decimal
                $servicoProduto->valor_produto = (float) $valor_produto;
                $servicoProduto->quantidade = $produto['quantidade'];
                $servicoProduto->save();
            }

            // Armazena os dados completos na sessão
            $request->session()->put('dados_completo', $dados_completo);

            return redirect()->route('site.servico-finalizado');

        } catch (Throwable $e) {
            return view('site.servico', compact('clientes'))->
            with('error', 'Erro ao finalizar serviço: ' . $e->getMessage());
        }
    }

    public function servicoFinalizado(Request $request)
    {
        try {
            // Recupera os dados do serviço da sessão
            $dados_completo = $request->session()->get('dados_completo');

            // Verifica se os dados do serviço estão presentes na sessão
            if (!$dados_completo) {
                return redirect()->route('site.servico')->with('error', 'Erro ao exibir sucesso: Dados do serviço não encontrados.');
            }

            return view('site.servico-finalizado', compact('dados_completo'));
        } catch (Throwable $e) {
            return redirect()->route('site.servico')->with('error', 'Erro ao exibir sucesso: ' . $e->getMessage());
        }
    }

    public function gerarPdf(Request $request)
    {
        try {
            // Recupere os dados do serviço da sessão se não forem passados como parâmetro
            $dados_completo = $request->session()->get('dados_completo');

            // Recupere o cliente associado ao serviço
            $cliente = ClientesModel::find($dados_completo['id_cliente']);

            // Verifique se o cliente foi encontrado com sucesso
            if (!$cliente) {
                throw new Exception('Cliente não encontrado.');
            }

            // Verifique se os produtos estão presentes nos dados do serviço
            if (!isset($dados_completo['produtos'])) {
                throw new Exception('Produtos não encontrados nos dados do serviço.');
            }

            // Recupere os IDs dos produtos do serviço
            $produtosIds = array_column($dados_completo['produtos'], 'id_produto');

            // Busque os detalhes dos produtos com base nos IDs
            $produtosDetalhes = ProdutosModel::whereIn('id', $produtosIds)->get();

            // Combine os detalhes dos produtos com os dados do serviço
            foreach ($dados_completo['produtos'] as &$produto) {
                foreach ($produtosDetalhes as $produtoDetalhe) {
                    if ($produto['id_produto'] == $produtoDetalhe->id) {
                        $produto['nome'] = $produtoDetalhe->nome;
                        // Adicione outros detalhes do produto conforme necessário
                        break;
                    }
                }
            }

            // Retorne a visualização da página do PDF
            return view('site.visualizar-pdf', compact('dados_completo', 'cliente'));
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Erro ao gerar PDF: ' . $e->getMessage());
        }
    }

    public function exportarPdf(Request $request): ?RedirectResponse
    {
        try {
            // Recupere os dados do serviço da sessão se não forem passados como parâmetro
            $dadosServico = $request->get('dados_servico');

            // Recupere o cliente associado ao serviço
            $cliente = ClientesModel::find($dadosServico['id_cliente']);

            // Verifique se o cliente foi encontrado com sucesso
            if (!$cliente) {
                throw new Exception('Cliente não encontrado.');
            }

            // Verifique se os produtos estão presentes nos dados do serviço
            if (!isset($dadosServico['produtos'])) {
                throw new Exception('Produtos não encontrados nos dados do serviço.');
            }

            // Recupere os IDs dos produtos do serviço
            $produtosIds = array_column($dadosServico['produtos'], 'id_produto');

            // Busque os detalhes dos produtos com base nos IDs
            $produtosDetalhes = ProdutosModel::whereIn('id', $produtosIds)->get();

            // Combine os detalhes dos produtos com os dados do serviço
            foreach ($dadosServico['produtos'] as &$produto) {
                foreach ($produtosDetalhes as $produtoDetalhe) {
                    if ($produto['id_produto'] == $produtoDetalhe->id) {
                        $produto['nome'] = $produtoDetalhe->nome;
                        // Adicione outros detalhes do produto conforme necessário
                        break;
                    }
                }
            }

            // Crie uma nova instância do Dompdf
            $dompdf = new Dompdf();

            // Renderize a visualização da página do PDF
            $dompdf->loadHtml(View::make('site.exportar-pdf',
                compact('dadosServico', 'cliente'))->render());

            // Renderize o PDF
            $dompdf->render();

            // Envie o PDF para o navegador
            return $dompdf->stream('exportar-pdf');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao exportar PDF: ' . $e->getMessage());
        }
    }

    public function buscarProdutos(Request $request): JsonResponse
    {
        try {
            $query = $request->input('query');

            // Lógica para buscar produtos com base na consulta do usuário
            $produtos = ProdutosModel::where('nome', 'like', '%' . $query . '%')->get();

            // Retorna os resultados da busca como um array JSON
            return response()->json($produtos);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Erro ao buscar produtos: ' . $e->getMessage()]);
        }
    }
}
