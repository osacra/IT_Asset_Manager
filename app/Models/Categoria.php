<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Categoria extends Model
{
    //
    protected $table ='categorias';

    protected $fillable = [
        'nome',
        'descricao',
    ];
    /**
     * Relacionamento: Uma categoria possui muitos ativos.
     */
    public function ativos(): HasMany
    {
        return $this->hasMany(Ativo::class, 'categoria_id');
    }
}
