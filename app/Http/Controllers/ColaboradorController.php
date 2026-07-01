<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Http\Requests\ColaboradorRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ColaboradorController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Colaborador::class, 'colaborador');
    }

    public function index(): View
    {
        $colaboradores = Colaborador::orderBy('nome', 'asc')->paginate(10);
        return view('colaboradores.index', compact('colaboradores'));
    }

    public function create(): View
    {
        return view('colaboradores.create');
    }

    public function store(ColaboradorRequest $request): RedirectResponse
    {
        Colaborador::create($request->validated());

        return redirect()->route('colaboradores.index')
            ->with('success', 'Colaborador cadastrado com sucesso!');
    }

    public function edit(Colaborador $colaborador): View
    {
        return view('colaboradores.edit', compact('colaborador'));
    }

    public function update(ColaboradorRequest $request, Colaborador $colaborador): RedirectResponse
    {
        $colaborador->update($request->validated());

        return redirect()->route('colaboradores.index')
            ->with('success', 'Colaborador atualizado com sucesso!');
    }

    public function destroy(Colaborador $colaborador): RedirectResponse
    {
        // Regra de Negócio: Verificar se possui empréstimos atrelados
        if ($colaborador->emprestimos()->exists()) {
            return redirect()->route('colaboradores.index')
                ->with('error', 'Não é possível excluir um colaborador que possui histórico de empréstimo de ativos.');
        }

        $colaborador->delete();

        return redirect()->route('colaboradores.index')
            ->with('success', 'Colaborador excluído com sucesso!');
    }
}