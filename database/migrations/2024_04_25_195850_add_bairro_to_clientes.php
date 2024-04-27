<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBairroToClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Adiciona o novo campo 'bairro' depois de 'cidade'
            $table->string('bairro')->after('cidade')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Adiciona o novo campo 'bairro' depois de 'cidade'
            $table->string('bairro')->after('cidade')->nullable();

        });
    }
}
