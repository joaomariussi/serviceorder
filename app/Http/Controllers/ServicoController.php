<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ProdutosModel;
use Illuminate\Http\JsonResponse;
use Throwable;

class ServicoController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::all();
            return view('site.servico', compact('clientes'));
        } catch (Throwable $e) {
            return view('site.servico', compact($e->getMessage()));
        }
    }

    public function criarServico()
    {

        return view('site.finalizar-servico');
    }

    public function listarProdutos(): JsonResponse
    {
        try {
            $produtos = ProdutosModel::all();
            return response()->json($produtos);
        } catch (Throwable $e) {
            return response()->json($e->getMessage());
        }
    }
}
