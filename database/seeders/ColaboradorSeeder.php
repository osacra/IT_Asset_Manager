<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colaborador;

class ColaboradorSeeder extends Seeder
{
    public function run(): void
    {
        Colaborador::create([
            'nome' => 'João Silva',
            'email' => 'joao@empresa.com',
            'departamento' => 'TI',
            'cargo' => 'Analista'
        ]);

        Colaborador::create([
            'nome' => 'Maria Souza',
            'email' => 'maria@empresa.com',
            'departamento' => 'Logística',
            'cargo' => 'Assistente'
        ]);
    }
}