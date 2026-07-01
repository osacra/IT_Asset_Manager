<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StatusAtivoSeeder::class,
            UserSeeder::class,
            CategoriaSeeder::class,
            ColaboradorSeeder::class,
            AtivoSeeder::class,
            EmprestimoSeeder::class,
            HistoricoMovimentacaoSeeder::class,
        ]);
    }
}