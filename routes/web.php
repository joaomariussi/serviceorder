<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
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

    // Rotas relacionadas à ordem de serviço
    Route::get('/servico', [ServicoController::class, 'index'])->name('site.servico')->middleware('auth');
    Route::post('/servico', [ServicoController::class, 'criarServico'])->name('site.criar-servico')->middleware('auth');
    Route::any('/finalizar-servico', [ServicoController::class, 'finalizarServico'])->name('site.finalizar-servico')->middleware('auth');
    Route::get('/servico-pdf', [ServicoController::class, 'gerarPdf'])->name('site.servico-pdf')->middleware('auth');
    Route::get('/exportar-pdf', [ServicoController::class, 'exportarPdf'])->name('site.exportar-pdf')->middleware('auth');

    // Adicionando a rota para a view de sucesso
    Route::get('/servico-finalizado', [ServicoController::class, 'servicoFinalizado'])->name('site.servico-finalizado')->middleware('auth');

    Route::get('/produtos', [ServicoController::class, 'buscarProdutos'])->name('produtos.listar');
});
