<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ativo;

class AtivoSeeder extends Seeder
{
    public function run(): void
    {
        Ativo::create([
            'categoria_id' => 1,
            'status_ativo_id' => 1,
            'patrimonio' => 'PAT-001',
            'nome' => 'Notebook Dell Latitude',
            'marca' => 'Dell',
            'modelo' => 'Latitude 5420',
            'numero_serie' => 'SN123456',
            'data_aquisicao' => now(),
            'valor' => 4500.00,
            'localizacao' => 'TI - Sala 1',
        ]);
    }
}
