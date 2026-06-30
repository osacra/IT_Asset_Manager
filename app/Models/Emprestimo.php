<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprestimo extends Model
{
    protected $table = 'emprestimos';

    protected $fillable = [
        'ativo_id',
        'colaborador_id',
        'usuario_id',
        'data_emprestimo',
        'previsao_devolucao',
        'data_devolucao',
        'observacoes',
    ];

    protected function casts(): array
    {
        return [
            'data_emprestimo' => 'datetime',
            'previsao_devolucao' => 'date',
            'data_devolucao' => 'datetime',
        ];
    }

    public function ativo(): BelongsTo
    {
        return $this->belongsTo(Ativo::class, 'ativo_id');
    }

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class, 'colaborador_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}