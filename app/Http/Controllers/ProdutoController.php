<?php

namespace App\Http\Controllers;

use App\Models\ProdutosModel;
use Exception;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    public function visualizarProdutos()
    {
        try {
            $produtos = ProdutosModel::all();
            return view('app.produto.index', compact('produtos'));
        } catch (Exception $e) {
            return view('app.produto.index')->with('error', 'Erro ao carregar a página de produtos: ' . $e->getMessage());
        }
    }

    public function excluir($id): JsonResponse
    {
        try {
            $produto = ProdutosModel::find($id);

            if (!$produto) {
                flash()->error('Produto não encontrado.');
                return response()->json(['error' => 'Produto não encontrado.'], 404);
            }

            if ($produto->pedido()->exists()) {
                flash()->error('Produto não pode ser excluído, pois está associado a um pedido.');
                return response()->json(['error' => 'Produto não pode ser excluído, pois está associado a um pedido.'], 400);
            }

            $produto->delete();
            flash()->success('Produto excluído com sucesso!');
            return response()->json(['message' => 'Produto excluído com sucesso!']);
        } catch (Exception $e) {
            flash()->error('Erro ao excluir o produto: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function visualizar($id)
    {
        try {
            $produto = ProdutosModel::findOrFail($id);

            if (!$produto) {
                flash()->error('Produto não encontrado.');
                return redirect()->route('app.produto.index');
            }

            $pedidos = $produto->pedido()->with('servico')->get();
            $quantidadeVendas = $pedidos->count();

            return view('app.produto.visualizar',
                compact('produto',
                    'pedidos',
                    'quantidadeVendas'
                ));
        } catch (Exception $e) {
            return view('app.produto.visualizar')->with('error',
                'Erro ao carregar a página de visualização do produto: ' .
                $e->getMessage()
            );
        }
    }

}
