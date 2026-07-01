<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HistoricoMovimentacao;

class HistoricoMovimentacaoSeeder extends Seeder
{
    public function run(): void
    {
        HistoricoMovimentacao::create([
            'ativo_id' => 1,
            'usuario_id' => 1,
            'tipo' => 'Cadastro',
            'descricao' => 'Histórico inicial gerado pelo seeder',
        ]);
    }
}