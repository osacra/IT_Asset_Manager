<?php

namespace App\Policies;

use App\Models\Emprestimo;
use App\Models\User;

class EmprestimoPolicy
{
    // Tanto administradores quanto técnicos podem ver e registrar empréstimos/devoluções
    public function viewAny(User $user): bool { return true; }
    public function create(User $user): bool { return true; }
    
    // Apenas administradores podem gerenciar ações destrutivas ou edições retroativas se necessárias
    public function update(User $user, Emprestimo $emprestimo): bool { return $user->role === 'administrador'; }
    public function delete(User $user, Emprestimo $emprestimo): bool { return $user->role === 'administrador'; }
}