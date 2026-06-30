<?php

namespace App\Observers;

use App\Models\Ativo;
use App\Models\HistoricoMovimentacao;
use Illuminate\Support\Facades\Auth;

class AtivoObserver
{
    public function created(Ativo $ativo): void
    {
        HistoricoMovimentacao::create([
            'ativo_id'   => $ativo->id,
            'usuario_id' => Auth::id() ?? 1, // Fallback para seeder se necessário
            'tipo'       => 'Cadastro',
            'descricao'  => "Ativo único cadastrado com patrimônio nº {$ativo->patrimonio} e status inicial.",
        ]);
    }
}