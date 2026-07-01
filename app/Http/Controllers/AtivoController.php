<?php

namespace App\Http\Controllers;

use App\Models\Ativo;
use App\Models\Categoria;
use App\Models\StatusAtivo;
use App\Http\Requests\AtivoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

class AtivoController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Ativo::class, 'ativo');
    }

    public function index(): View
    {
        // Eager loading para evitar o problema de N+1 consultas no banco
        $ativos = Ativo::with(['categoria', 'statusAtivo'])->paginate(10);
        return view('ativos.index', compact('ativos'));
    }

    public function create(): View
    {
        $categorias = Categoria::orderBy('nome')->get();
        $statusAtivos = StatusAtivo::all();
        return view('ativos.create', compact('categorias', 'statusAtivos'));
    }

    public function store(AtivoRequest $request): RedirectResponse
    {
        Ativo::create($request->validated());

        return redirect()->route('ativos.index')
            ->with('success', 'Ativo cadastrado com sucesso!');
    }

    public function show(Ativo $ativo): View
    {
        // Carrega o histórico de movimentações do ativo ordenado por data
        $ativo->load(['categoria', 'statusAtivo', 'historicos.usuario']);
        return view('ativos.show', compact('ativo'));
    }

    public function edit(Ativo $ativo): View
    {
        $categorias = Categoria::orderBy('nome')->get();
        $statusAtivos = StatusAtivo::all();
        return view('ativos.edit', compact('ativo', 'categorias', 'statusAtivos'));
    }

    public function update(AtivoRequest $request, Ativo $ativo): RedirectResponse
    {
        $ativo->update($request->validated());

        return redirect()->route('ativos.index')
            ->with('success', 'Ativo atualizado com sucesso!');
    }

    public function destroy(Ativo $ativo): RedirectResponse
    {
        // Regra de Negócio: Verificar se o ativo possui empréstimos vinculados antes de deletar
        if ($ativo->emprestimos()->exists()) {
            return redirect()->route('ativos.index')
                ->with('error', 'Não é possível excluir um ativo que possui histórico de empréstimos.');
        }

        $ativo->delete();

        return redirect()->route('ativos.index')
            ->with('success', 'Ativo excluído com sucesso!');
    }
}