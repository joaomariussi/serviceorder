<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            'nome' => 'João Pedro Mariussi',
            'email' => 'joaomariussi10@gmail.com',
            'cpf' => '01040688098',
            'endereco' => 'Rua dos Bobos, nº 0',
            'cidade' => 'São Paulo',
            'bairro' => 'Vila do Chaves',
            'estado' => 'SP',
            'cep' => '01010101',
            'telefone' => '11999999999',
            'data_nascimento' => '1999-10-10',
            'sexo' => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
