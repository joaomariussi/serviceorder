<?php

namespace App\Http\Controllers;

use App\Models\ProdutosModel;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProdutoController extends Controller
{
    public function index(): Factory|View|Application
    {
        try {
            $produtos = ProdutosModel::all();
            return view('site.produto.index', compact('produtos'));
        } catch (Exception $e) {
            return view('site.produto.index', ['message' => $e->getMessage()]);
        }
    }
}
