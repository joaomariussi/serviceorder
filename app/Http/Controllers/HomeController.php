<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ProdutosModel;
use App\Models\ServicoModel;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Resgata o usuário logado e retorna a view home
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $user = Auth::user();
        try {
            $total_pedidos = (new ServicoModel())->count();
            $total_clientes = (new ClientesModel())->count();
            $total_produtos = (new ProdutosModel())->count();

            return view('site.home', [
                'total_pedidos' => $total_pedidos,
                'total_clientes' => $total_clientes,
                'total_produtos' => $total_produtos,
                'user' => $user
            ]);
        } catch (Exception) {
            return view('site.home', [
                'total_pedidos' => 0,
                'total_clientes' => 0,
                'total_produtos' => 0,
                'user' => $user
            ]);
        }
    }
}
