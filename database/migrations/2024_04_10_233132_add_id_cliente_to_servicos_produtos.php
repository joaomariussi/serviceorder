<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdClienteToServicosProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicos_produtos', function (Blueprint $table) {
            // Adiciona a coluna cliente_id após servico_id
            $table->unsignedBigInteger('cliente_id')->after('servico_id');

            // Adiciona a chave estrangeira para cliente_id
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicos_produtos', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna cliente_id
            $table->dropForeign(['cliente_id']);
            $table->dropColumn('cliente_id');
        });
    }
}
