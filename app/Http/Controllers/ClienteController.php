<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use Exception;

class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::all();
            return view('site.cliente.index', compact('clientes'));
        } catch (Exception $e) {
            return view('site.cliente.index', ['message' => $e->getMessage()]);
        }
    }
}
