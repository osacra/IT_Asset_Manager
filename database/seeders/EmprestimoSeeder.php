<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Emprestimo;

class EmprestimoSeeder extends Seeder
{
    public function run(): void
    {
        Emprestimo::create([
            'ativo_id' => 1,
            'colaborador_id' => 1,
            'usuario_id' => 1,
            'data_emprestimo' => now(),
            'previsao_devolucao' => now()->addDays(7),
            'observacoes' => 'Empréstimo inicial para testes'
        ]);
    }
}