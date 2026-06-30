<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusAtivo extends Model
{
    protected $table = 'status_ativos';

    protected $fillable = [
        'nome',
    ];

    /**
     * Relacionamento: Um status pode estar associado a muitos ativos.
     */
    public function ativos(): HasMany
    {
        return $this->hasMany(Ativo::class, 'status_ativo_id');
    }
}