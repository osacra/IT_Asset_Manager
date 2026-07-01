<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Ativo;
use App\Models\Colaborador;
use App\Models\StatusAtivo;
use App\Http\Requests\EmprestimoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmprestimoController extends Controller
{
    public function index(): View
    {
        // Eager loading para evitar N+1 queries
        $emprestimos = Emprestimo::with(['ativo', 'colaborador', 'usuario'])
            ->orderBy('data_retorno', 'asc') 
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create(): View
    {
        // Só permite emprestar ativos que estejam com status 'Disponível'
        $statusDisponivel = StatusAtivo::where('nome', 'Disponível')->first();
        $ativos = Ativo::where('status_ativo_id', $statusDisponivel->id)->orderBy('nome', 'asc')->get();
        
        $colaboradores = Colaborador::orderBy('nome', 'asc')->get();

        return view('emprestimos.create', compact('ativos', 'colaboradores'));
    }

    public function store(EmprestimoRequest $request): RedirectResponse
    {
        $statusEmUso = StatusAtivo::where('nome', 'Em uso')->first();
        $ativo = Ativo::findOrFail($request->ativo_id);

        // Proteção extra contra concorrência: verificar se o ativo não foi levado por outro usuário segundos antes
        if ($ativo->statusAtivo->nome !== 'Disponível') {
            return redirect()->back()->withInput()->with('error', 'Este ativo já não está mais disponível para empréstimo.');
        }

        // ACID Transaction: Salva tudo ou desfaz tudo em caso de falha elétrica/banco
        DB::transaction(function () use ($request, $ativo, $statusEmUso) {
            // 1. Criar o registro do Empréstimo
            Emprestimo::create([
                'ativo_id'       => $request->ativo_id,
                'colaborador_id' => $request->colaborador_id,
                'usuario_id'     => Auth::id(),
                'data_retirada'  => $request->data_retirada,
                'observacoes'    => $request->observacoes,
            ]);

            // 2. Atualizar o status do Ativo para 'Em uso'
            $ativo->update(['status_ativo_id' => $statusEmUso->id]);
        });

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo registrado e status do ativo atualizado!');
    }

    public function devolver(Request $request, Emprestimo $emprestimo): RedirectResponse
    {
        $statusDisponivel = StatusAtivo::where('nome', 'Disponível')->first();

        DB::transaction(function () use ($emprestimo, $statusDisponivel) {
            // 1. Atualizar o registro do empréstimo com a data de retorno
            $emprestimo->update([
                'data_retorno' => now(),
            ]);

            // 2. Atualizar o status do ativo de volta para 'Disponível'
            $emprestimo->ativo->update([
                'status_ativo_id' => $statusDisponivel->id
            ]);
        });

        return redirect()->route('emprestimos.index')->with('success', 'Devolução concluída! O ativo retornou ao estoque disponível.');
    }
}