<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

// Todas as rotas estão dentro do grupo 'web' e, portanto, são protegidas pelo middleware 'web'
Route::group(['middleware' => 'web'], function () {

    // Rota da página inicial
    Route::get('/', [HomeController::class, 'index'])->name('site.home')->middleware('auth');

    // Rotas relacionadas à autenticação
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Rotas relacionadas à ordem de serviço
    Route::get('/servico', [ServicoController::class, 'index'])->name('site.servico')->middleware('auth');
    Route::post('/servico', [ServicoController::class, 'criarServico'])->name('site.criar-servico')->middleware('auth');
//    Route::get('/finalizar-servico', [ServicoController::class, 'finalizarServico'])->name('site.finalizar-servico')->middleware('auth');
    Route::any('/finalizar-servico', [ServicoController::class, 'finalizarServico'])->name('site.finalizar-servico')->middleware('auth');

    Route::get('/produtos', [ServicoController::class, 'listarProdutos'])->name('produtos.listar');
});
