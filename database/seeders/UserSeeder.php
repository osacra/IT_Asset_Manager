<?php

namespace database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Criando o Administrador padrão
        User::updateOrCreate(
            ['email' => 'admin@itasset.com'],
            [
                'name' => 'Administrador TI',
                'password' => Hash::make('senha123'),
                'role' => 'administrador',
            ]
        );

        // Criando o Técnico padrão
        User::updateOrCreate(
            ['email' => 'tecnico@itasset.com'],
            [
                'name' => 'Técnico Suporte',
                'password' => Hash::make('senha123'),
                'role' => 'tecnico',
            ]
        );
    }
}