<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('produtos')->insert([
            'codigo' => '12345678',
            'nome' => 'Bicicleta',
            'descricao' => 'Bicicleta aro 26',
            'preco' => 1000.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
