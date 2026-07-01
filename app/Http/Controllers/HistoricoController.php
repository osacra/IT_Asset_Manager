<?php

namespace App\Http\Controllers;

use App\Models\HistoricoMovimentacao;
use Illuminate\View\View;

class HistoricoController extends Controller
{

    public function index(): View
    {
        
        $historicos = HistoricoMovimentacao::with(['ativo', 'usuario'])
            ->latest()
            ->paginate(15);

        return view('historicos.index', compact('historicos'));
    }
}