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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmprestimoController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Emprestimo::class, 'emprestimo');
    }

    public function index(): View
    {
        $emprestimos = Emprestimo::with(['ativo', 'colaborador', 'usuario'])
            ->orderBy('data_devolucao', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create(): View
    {
        $statusDisponivel = StatusAtivo::where('nome', 'Disponível')->first();

        $ativos = Ativo::where('status_ativo_id', $statusDisponivel->id)
            ->orderBy('nome', 'asc')
            ->get();

        $colaboradores = Colaborador::orderBy('nome', 'asc')->get();

        return view('emprestimos.create', compact('ativos', 'colaboradores'));
    }

    public function store(EmprestimoRequest $request): RedirectResponse
    {
        $statusEmUso = StatusAtivo::where('nome', 'Em uso')->first();
        $ativo = Ativo::findOrFail($request->ativo_id);

        if ($ativo->status->nome !== 'Disponível') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Este ativo já não está mais disponível.');
        }

        DB::transaction(function () use ($request, $ativo, $statusEmUso) {
            Emprestimo::create([
                'ativo_id'       => $request->ativo_id,
                'colaborador_id' => $request->colaborador_id,
                'usuario_id'     => Auth::id(),
                'data_emprestimo' => $request->data_emprestimo,
                'observacoes'    => $request->observacoes,
            ]);

            $ativo->update([
                'status_ativo_id' => $statusEmUso->id
            ]);
        });

        return redirect()
            ->route('emprestimos.index')
            ->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function devolver(Request $request, Emprestimo $emprestimo): RedirectResponse
    {
        $statusDisponivel = StatusAtivo::where('nome', 'Disponível')->first();

        DB::transaction(function () use ($emprestimo, $statusDisponivel) {
            $emprestimo->update([
                'data_devolucao' => now(),
            ]);

            $emprestimo->ativo->update([
                'status_ativo_id' => $statusDisponivel->id
            ]);
        });

        return redirect()
            ->route('emprestimos.index')
            ->with('success', 'Devolução realizada com sucesso!');
    }
}