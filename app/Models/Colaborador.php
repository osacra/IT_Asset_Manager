<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colaborador extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = [
        'nome',
        'email',
        'departamento',
        'cargo',
    ];

    /**
     * Relacionamento: Um colaborador pode ter muitos empréstimos.
     */
    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class, 'colaborador_id');
    }
}