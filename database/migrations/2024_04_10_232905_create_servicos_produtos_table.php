<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servico_id');
            $table->unsignedBigInteger('produto_id');
            $table->decimal('valor_produto', 10, 2); // Altere os parâmetros conforme necessário
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos_produtos');
    }
}
