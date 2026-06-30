<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricoMovimentacao extends Model
{
    protected $table = 'historico_movimentacoes';

    // Desativei os timestamps padrão do Laravel pois usei apenas o created_at nesta tabela
    public $timestamps = false;

    protected $fillable = [
        'ativo_id',
        'usuario_id',
        'tipo',
        'descricao',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function ativo(): BelongsTo
    {
        return $this->belongsTo(Ativo::class, 'ativo_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}