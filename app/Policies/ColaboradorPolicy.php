<?php

namespace App\Policies;

use App\Models\Colaborador;
use App\Models\User;

class ColaboradorPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Colaborador $colaborador): bool { return true; }
    
    public function create(User $user): bool { return $user->role === 'administrador'; }
    public function update(User $user, Colaborador $colaborador): bool { return $user->role === 'administrador'; }
    public function delete(User $user, Colaborador $colaborador): bool { return $user->role === 'administrador'; }
}