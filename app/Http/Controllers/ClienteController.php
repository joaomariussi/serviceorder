<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function index(): Factory|View|Application
    {
        try {
            $clientes = ClientesModel::all();
            return view('site.cliente.index', compact('clientes'));
        } catch (Exception $e) {
            return view('site.cliente.index', ['message' => $e->getMessage()]);
        }
    }

    public function excluir($id): JsonResponse
    {
        try {
            // Busca o cliente pelo ID
            $cliente = (new ClientesModel)->find($id);

            // Verifica se o cliente existe
            if ($cliente) {
                // Verifica se há serviços associados
                if ($cliente->servico()->exists()) {
                    return response()->json(['error' => 'Cliente não pode ser excluído, pois possui serviços associados.'], 400);
                }

                // Exclui o cliente do banco de dados
                $cliente->delete();
                return response()->json(['message' => 'Cliente excluído com sucesso!']);
            } else {
                return response()->json(['error' => 'Cliente não encontrado!'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
