<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomeProdutoToServicosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('servicos_produtos', function (Blueprint $table) {
            $table->string('nome_produto')->after('id_produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('servicos_produtos', function (Blueprint $table) {
            $table->dropColumn('nome_produto');
        });
    }
}
