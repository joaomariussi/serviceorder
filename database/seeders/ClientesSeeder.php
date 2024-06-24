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

        DB::table('clientes')->insert([
            'nome' => 'Lucas Santos',
            'email' => 'lucas@gmail.com',
            'cpf' => '65065065065',
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

        DB::table('clientes')->insert([
            'nome' => 'Wanderson Silva Santos',
            'email' => 'wande11gmail.com',
            'cpf' => '01040588592',
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

        DB::table('clientes')->insert([
            'nome' => 'Gilson Nunes',
            'email' => 'nunesgilson@gmail.com',
            'cpf' => '58958958958',
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

        DB::table('clientes')->insert([
            'nome' => 'Gabriel Silva',
            'email' => 'gabe@gmail.com',
            'cpf' => '53153153153',
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

        DB::table('clientes')->insert([
            'nome' => 'Vanderlei Barbosa',
            'email' => 'barbosa01@gmail.com',
            'cpf' => '98798798798',
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

        DB::table('clientes')->insert([
            'nome' => 'Luciano Azevedo',
            'email' => 'luciano@hotmail.com',
            'cpf' => '01040655598',
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

        DB::table('clientes')->insert([
            'nome' => 'Wesley Silva',
            'email' => 'wesley@gmail.com',
            'cpf' => '98798755798',
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
