<?php

namespace Database\Seeders;

use App\Models\StatusAtivo;
use Illuminate\Database\Seeder;

class StatusAtivoSeeder extends Seeder
{
    public function run(): void
    {
        $status = [
            'Disponível',
            'Em uso',
            'Em manutenção',
            'Baixado',
        ];

        foreach ($status as $nome) {
            StatusAtivo::updateOrCreate(['nome' => $nome]);
        }
    }
}