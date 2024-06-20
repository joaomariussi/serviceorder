<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsInServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('servicos', function (Blueprint $table) {
            $table->decimal('valor_mao_de_obra', 10, 2)->change();
            $table->decimal('valor_total', 10, 2)->change();
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
            //
        });
    }
}
