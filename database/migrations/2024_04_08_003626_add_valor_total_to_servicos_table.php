<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorTotalToServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicos', function (Blueprint $table) {
            // Adiciona o novo campo 'valor_total' depois de 'valor_produtos'
            $table->decimal('valor_total', 10, 2)->after('valor_produtos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicos', function (Blueprint $table) {
            // Reverte a adição do campo 'valor_total'
            $table->dropColumn('valor_total');
        });
    }
}
