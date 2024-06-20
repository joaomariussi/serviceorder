<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

// Todas as rotas estão dentro do grupo 'web', portanto, são protegidas pelo middleware 'web'
Route::group(['middleware' => 'web'], function () {

    // Rota da página inicial
    Route::get('/', [HomeController::class, 'index'])->name('site.home')->middleware('auth');

    // Rotas relacionadas à autenticação
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::group(['prefix' => '/clientes'], function () {
        Route::get('/', [ClienteController::class, 'index'])->name('site.cliente');
        Route::delete('/excluir/{id}', [ClienteController::class, 'excluir'])->name('site.cliente.excluir');
    });

    // Rotas relacionadas aos serviços
    Route::group(['prefix' => '/servico'], function () {
        Route::get('/', [ServicoController::class, 'index'])->name('site.servico');
        Route::get('/criar', [ServicoController::class, 'criarServico'])->name('site.criar-servico');
        Route::post('/criar', [ServicoController::class, 'criarServico'])->name('site.salvar-servico');
        Route::get('/finalizar', [ServicoController::class, 'finalizarServico'])->name('site.finalizar-servico');
        Route::post('/finalizar', [ServicoController::class, 'finalizarServico'])->name('site.finalizar-servico');
        Route::get('/finalizado', [ServicoController::class, 'servicoFinalizado'])->name('site.servico-finalizado');
        Route::get('/pdf', [ServicoController::class, 'gerarPdf'])->name('site.servico-pdf');
        Route::get('/exportar-pdf', [ServicoController::class, 'exportarPdf'])->name('site.exportar-pdf');
    });

    // Rota relacionada aos produtos
    Route::group(['prefix' => '/produtos'], function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('site.produto');
    });

    // Rota para buscar produtos
    Route::get('/produtos', [ServicoController::class, 'buscarProdutos'])->name('produtos.listar');
});
