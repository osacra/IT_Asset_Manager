<?php

namespace App\Http\Controllers;

use App\Models\Ativo;
use App\Models\Emprestimo;
use App\Models\HistoricoMovimentacao;
use App\Models\StatusAtivo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Exibe o painel do Dashboard com as métricas consolidadas.
     */
    public function __invoke(Request $request): View
    {
        // 1. Contadores Gerais de Ativos
        $totalAtivos = Ativo::count();
        
        // Buscamos os IDs dos status para garantir consultas precisas baseadas nos nomes padrões do Seeder
        $ativosDisponiveis = Ativo::whereHas('status', function($query) {
            $query->where('nome', 'Disponível');
        })->count();

        $ativosEmprestados = Ativo::whereHas('status', function($query) {
            $query->where('nome', 'Em uso');
        })->count();

        $ativosManutencao = Ativo::whereHas('status', function($query) {
            $query->where('nome', 'Em manutenção');
        })->count();

        // 2. Últimos 5 Empréstimos realizados (com Eager Loading para evitar o problema de consulta N+1)
        $ultimosEmprestimos = Emprestimo::with(['ativo', 'colaborador'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Últimas 5 Movimentações do histórico
        $ultimasMovimentacoes = HistoricoMovimentacao::with(['ativo', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAtivos',
            'ativosDisponiveis',
            'ativosEmprestados',
            'ativosManutencao',
            'ultimosEmprestimos',
            'ultimasMovimentacoes'
        ));
    }
}