<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ProdutosModel;
use App\Models\ServicoModel;
use App\Models\ServicosProdutosModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServicoController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::all();
            return view('app.servico.criar-servico', compact('clientes'));
        } catch (Throwable $e) {
            return view('app.servico.criar-servico')->with('error', 'Erro ao carregar a página de serviço: ' . $e->getMessage());
        }
    }

    public function criarServico(Request $request): Factory|View|RedirectResponse|Application
    {
        // Inicia uma transação
        DB::beginTransaction();

        try {
            $clientes = ClientesModel::all(); // Busca os clientes novamente
            $request->session()->put('dados_servico', $request->all());

            $dados_servico = $request->session()->get('dados_servico');

            // Commita a transação
            DB::commit();

            return view('app.servico.finalizar-servico', compact('dados_servico', 'clientes'));

        } catch (Throwable $e) {
            // Rollback da transação em caso de erro
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao criar serviço: ' . $e->getMessage());
        }
    }

    public function finalizarServico(Request $request): View|Factory|Application|RedirectResponse
    {
        // Inicia uma transação
        DB::beginTransaction();

        try {
            if (!$request->session()->has('dados_servico')) {
                return view('app.servico.servico')->with('error',
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
            $valor_mao_de_obra = str_replace('R$ ', '', $dados_completo['valor_mao_de_obra']);
            // Remover possíveis separadores de milhares (pontos)
            $valor_mao_de_obra = str_replace('.', '', $valor_mao_de_obra);
            // Substituir a vírgula decimal por ponto
            $valor_mao_de_obra = str_replace(',', '.', $valor_mao_de_obra);

            // Salva o serviço
            $servico = new ServicoModel();
            $servico->id_cliente = $dados_completo['id_cliente'] ?? null;
            $servico->nome_carro = $dados_completo['nome_carro'] ?? null;
            $servico->marca = $dados_completo['marca'] ?? null;
            $servico->modelo = $dados_completo['modelo'] ?? null;
            $servico->ano = $dados_completo['ano'] ?? null;
            $servico->placa = $dados_completo['placa'] ?? null;
            $servico->valor_mao_de_obra = (float)$valor_mao_de_obra;
            $servico->valor_total = $dados_completo['valor_total'];
            $servico->save();

            // Percorre os produtos do serviço e salva no banco
            foreach ($dados_completo['produtos'] as $produto) {
                $servicoProduto = new ServicosProdutosModel();
                $servicoProduto->id_servico = $servico->id;
                $servicoProduto->id_cliente = $dados_completo['id_cliente'];
                $servicoProduto->id_produto = $produto['id_produto'];
                $servicoProduto->nome_produto = $produto['nome_produto'];

                // Remover o prefixo "R$ " do valor do produto antes de salvar
                $valor_produto = str_replace('R$ ', '', $produto['valor_produto']);
                // Remover possíveis separadores de milhares (pontos)
                $valor_produto = str_replace('.', '', $valor_produto);
                // Substituir a vírgula decimal por ponto
                $valor_produto = str_replace(',', '.', $valor_produto);
                // Converter para número decimal
                $servicoProduto->valor_produto = (float)$valor_produto;
                $servicoProduto->quantidade = $produto['quantidade'];
                $servicoProduto->save();

                // Atualiza a quantidade do produto no estoque
                $produtoModel = ProdutosModel::find($produto['id_produto']);
                if ($produtoModel) {
                    $produtoModel->quantidade -= $produto['quantidade'];
                    $produtoModel->save();
                }
            }

            // Armazena os dados completos na sessão
            $request->session()->put('dados_completo', $dados_completo);

            // Commita a transação
            DB::commit();

            // Redireciona para a view de serviço finalizado com o ID do serviço
            return redirect()->route('app.servico.servico-finalizado', ['id' => $servico->id]);

        } catch (Throwable $e) {
            // Rollback da transação em caso de erro
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao finalizar serviço: ' . $e->getMessage());
        }
    }

    public function servicoFinalizado(Request $request, $id): Factory|View|Application|RedirectResponse
    {
        try {
            // Recupera os dados do serviço da sessão
            $dados_completo = $request->session()->get('dados_completo');

            // Recupera o serviço com base no ID
            $servico = ServicoModel::find($id);

            // Verifica se os dados do serviço estão presentes na sessão
            if (!$dados_completo) {
                return redirect()->route('site.servico')->with('error',
                    'Erro ao exibir sucesso: Dados do serviço não encontrados.');
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
                        break;
                    }
                }
            }

            return view('app.servico.servico-finalizado', compact('dados_completo', 'servico'));
        } catch (Throwable $e) {
            return redirect()->route('app.servico.servico')->with('error', 'Erro ao exibir sucesso: ' . $e->getMessage());
        }
    }

    public function excluir($id): JsonResponse
    {
        try {
            $servico = ServicoModel::find($id);

            if ($servico) {
                // Excluí registros na tabela servicos_produtos associados ao serviço
                ServicosProdutosModel::where('id_servico', $id)->delete();
                // Excluí o serviço
                $servico->delete();
                flash()->success('Serviço excluído com sucesso!');
                return response()->json(['message' => 'Serviço excluído com sucesso!', 'servico' => $servico]);
            } else {
                flash()->error('Serviço não encontrado!');
                return response()->json(['error' => 'Serviço não encontrado!'], 404);
            }
        } catch (Exception $e) {
            flash()->error('Ocorreu um erro ao excluir o serviço. Por favor, tente novamente.');
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function gerarPdf(Request $request): Factory|View|RedirectResponse|Application
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
                        break;
                    }
                }
            }

            // Retorna a visualização da página do PDF
            return view('app.servico.visualizar-pdf', compact('dados_completo', 'cliente'));
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Erro ao gerar PDF: ' . $e->getMessage());
        }
    }

    public function exportarPdf($id): Response|RedirectResponse
    {
        try {
            $servico = ServicoModel::with('cliente')->find($id);

            if ($servico) {
                $servico_produtos = ServicosProdutosModel::where('id_servico', $id)->with('produto')->get();

                // Calcula a quantidade total de produtos no serviço
                $quantidade_total = $servico_produtos->sum('quantidade');

                // Calcular o valor total dos produtos
                $valor_produto_total = $servico_produtos->sum(function($servico_produto) {
                    return $servico_produto->quantidade * $servico_produto->valor_produto;
                });

                // Dados completos para a view do PDF
                $dados_completo = [
                    'nome_carro' => $servico->nome_carro,
                    'marca' => $servico->marca,
                    'modelo' => $servico->modelo,
                    'ano' => $servico->ano,
                    'placa' => $servico->placa,
                    'produtos' => $servico_produtos->toArray(),
                    'valor_total_produtos' => $valor_produto_total,
                    'valor_mao_de_obra' => $servico->valor_mao_de_obra,
                    'valor_total' => $servico->valor_total,
                ];

                // Carregar a visualização do PDF
                $pdf = PDF::loadView('app.servico.exportar-pdf',
                    compact(
                        'servico',
                        'servico_produtos',
                        'quantidade_total',
                        'dados_completo'
                    ));

                // Retorna o PDF para download
                return $pdf->download('servico_' . $servico->id . '.pdf');
            } else {
                return redirect()->back()->with('error', 'Serviço não encontrado!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao exportar PDF: ' . $e->getMessage());
        }
    }

    public function visualizarTodosServicos(): Factory|View|RedirectResponse|Application
    {
        try {
            // Recupere os dados do serviço da sessão se não forem passados como parâmetro
            $clientes = ClientesModel::all();
            $servicos = ServicoModel::with('cliente', 'produtos')->get();

            // Calcula quantidade total de produtos e valor total por pedido
            foreach ($servicos as $servico) {
                $servico->quantidade_total = $servico->produtos->sum('quantidade');
            }

            return view('app.servico.index', compact('clientes', 'servicos'));
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function visualizar($id): Factory|View|RedirectResponse|Application
    {
        try {
            $servico = ServicoModel::with('cliente')->find($id);

            if ($servico) {
                $servico_produtos = ServicosProdutosModel::where('id_servico', $id)->get();

                // Calcula a quantidade total de produtos no serviço
                $quantidade_total = $servico_produtos->sum('quantidade');

                return view('app.servico.visualizar',
                    compact('servico', 'servico_produtos', 'quantidade_total'));
            } else {
                return redirect()->back()->with('error', 'Serviço não encontrado!');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
