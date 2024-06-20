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
            $valor_total_pedidos = (new ServicoModel())->sum('valor_total');

            $recent_clients = (new ClientesModel())->orderBy('created_at', 'desc')->take(5)->get();
            $recent_orders = (new ServicoModel())->orderBy('created_at', 'desc')->take(5)->get();
            $recent_products = (new ProdutosModel())->orderBy('created_at', 'desc')->take(5)->get();

            return view('site.home', [
                'total_pedidos' => $total_pedidos,
                'total_clientes' => $total_clientes,
                'total_produtos' => $total_produtos,
                'valor_total_pedidos' => $valor_total_pedidos,
                'recent_clients' => $recent_clients,
                'recent_orders' => $recent_orders,
                'recent_products' => $recent_products,
                'user' => $user
            ]);
        } catch (Exception) {
            return view('site.home', [
                'total_pedidos' => 0,
                'total_clientes' => 0,
                'total_produtos' => 0,
                'valor_total_pedidos' => 0,
                'recent_clients' => [],
                'recent_orders' => [],
                'recent_products' => [],
                'user' => $user
            ]);
        }
    }
}
