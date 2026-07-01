<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::insert([
            ['nome' => 'Notebooks', 'descricao' => 'Computadores portáteis'],
            ['nome' => 'Monitores', 'descricao' => 'Monitores corporativos'],
            ['nome' => 'Periféricos', 'descricao' => 'Mouse, teclado e acessórios'],
        ]);
    }
}