<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nome' => 'Caique Oliveira',
            'email' => 'oliveira.caique@outlook.com.br',
            'endereco' => 'Rua gelindo thamos',
            'logradouro' => 'Rua gelindo thamos',
            'cep' => '14815000',
            'bairro' => 'Jardim Icaraí',
        ]);
        Cliente::create([
            'nome' => 'admin',
            'email' => 'oliveira.caique@outlook.com.br',
            'endereco' => 'Rua gelindo thamos',
            'logradouro' => 'Rua gelindo thamos',
            'cep' => '14815000',
            'bairro' => 'Jardim Icaraí',
        ]);
    }
}
