<?php

namespace App\Policies;

use App\Models\Ativo;
use App\Models\User;

class AtivoPolicy
{
    // Administradores e Técnicos podem visualizar
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Ativo $ativo): bool { return true; }

    // Apenas Administradores podem manipular dados
    public function create(User $user): bool { return $user->role === 'administrador'; }
    public function update(User $user, Ativo $ativo): bool { return $user->role === 'administrador'; }
    public function delete(User $user, Ativo $ativo): bool { return $user->role === 'administrador'; }
}