<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ativo extends Model
{
    protected $table = 'ativos';

    protected $fillable = [
        'categoria_id',
        'status_ativo_id',
        'patrimonio',
        'nome',
        'marca',
        'modelo',
        'numero_serie',
        'data_aquisicao',
        'valor',
        'localizacao',
        'observacoes',
    ];

    
    protected function casts(): array
    {
        return [
            'data_aquisicao' => 'date',
            'valor' => 'decimal:2',
        ];
    }

    /**
     * Relacionamento: O ativo pertence a uma categoria.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relacionamento: O ativo possui um status atual.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusAtivo::class, 'status_ativo_id');
    }

    /**
     * Relacionamento: Um ativo pode ter muitos registros de empréstimos ao longo do tempo.
     */
    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class, 'ativo_id');
    }

    /**
     * Relacionamento: Um ativo possui um histórico completo de movimentações.
     */
    public function historicos(): HasMany
    {
        return $this->hasMany(HistoricoMovimentacao::class, 'ativo_id');
    }
}