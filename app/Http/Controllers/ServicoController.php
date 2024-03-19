<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('site.servico')->with('user', $user);
    }

    public function criarServico()
    {
        $user = Auth::user();
        return view('site.finalizar-servico')->with('user', $user);
    }
}
