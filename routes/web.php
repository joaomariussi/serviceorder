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
        Route::get('/visualizar', [ClienteController::class, 'index'])->name('app.cliente');
        Route::delete('/excluir/{id}', [ClienteController::class, 'excluir'])->name('app.cliente.excluir');
    });

    // Rotas relacionadas aos serviços
    Route::group(['prefix' => '/servico'], function () {
        Route::get('/', [ServicoController::class, 'index'])->name('app.servico.servico');
        Route::get('/visualizar', [ServicoController::class, 'visualizarServico'])->name('app.servico.index');
        Route::get('/criar', [ServicoController::class, 'criarServico'])->name('app.servico.criar-servico');
        Route::post('/criar', [ServicoController::class, 'criarServico'])->name('app.servico.salvar-servico');
        Route::get('/finalizar', [ServicoController::class, 'finalizarServico'])->name('app.servico.finalizar-servico');
        Route::post('/finalizar', [ServicoController::class, 'finalizarServico'])->name('app.servico.finalizar-servico');
        Route::get('/finalizado', [ServicoController::class, 'servicoFinalizado'])->name('app.servico.servico-finalizado');
        Route::get('/pdf', [ServicoController::class, 'gerarPdf'])->name('app.servico.servico-pdf');
        Route::get('/exportar-pdf', [ServicoController::class, 'exportarPdf'])->name('app.servico.exportar-pdf');
    });

    // Rota relacionada aos produtos
    Route::group(['prefix' => '/produtos'], function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('app.produto.produto');
    });

    // Rota para buscar produtos
    Route::get('/produtos', [ServicoController::class, 'buscarProdutos'])->name('produtos.listar');
});
