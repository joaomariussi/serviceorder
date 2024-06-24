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
            'nome' => 'Radiador Gol Quadrado',
            'descricao' => 'Radiador Gol Quadrado',
            'preco' => 500.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '87654321',
            'nome' => 'Tampa do reservatório de óleo',
            'descricao' => 'Tampa do reservatório de óleo',
            'preco' => 87.99,
            'quantidade' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '12348765',
            'nome' => 'Bomba de combustível',
            'descricao' => 'Bomba de combustível',
            'preco' => 150.00,
            'quantidade' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '87651234',
            'nome' => 'Bomba de água',
            'descricao' => 'Bomba de água',
            'preco' => 120.00,
            'quantidade' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '11223344',
            'nome' => 'Radiador Gol Quadrado',
            'descricao' => 'Radiador Gol Quadrado',
            'preco' => 500.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '22334455',
            'nome' => 'Motor de arranque',
            'descricao' => 'Motor de arranque',
            'preco' => 750.00,
            'quantidade' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '33445566',
            'nome' => 'Alternador',
            'descricao' => 'Alternador',
            'preco' => 300.00,
            'quantidade' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '44556677',
            'nome' => 'Correia dentada',
            'descricao' => 'Correia dentada',
            'preco' => 50.00,
            'quantidade' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '55667788',
            'nome' => 'Correia do alternador',
            'descricao' => 'Correia do alternador',
            'preco' => 30.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '66778899',
            'nome' => 'Correia do ar condicionado',
            'descricao' => 'Correia do ar condicionado',
            'preco' => 30.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '87463512',
            'nome' => 'Ventoinha',
            'descricao' => 'Ventoinha Radiador Gol Quadrado CHT',
            'preco' => 55.99,
            'quantidade' => 25,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '88778899',
            'nome' => 'Vela de ignição',
            'descricao' => 'Vela de ignição',
            'preco' => 90.00,
            'quantidade' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('produtos')->insert([
            'codigo' => '88990011',
            'nome' => 'Bucha da bandeja',
            'descricao' => 'Bucha de bandeja, Volkswagen Gol',
            'preco' => 100.00,
            'quantidade' => 25,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
