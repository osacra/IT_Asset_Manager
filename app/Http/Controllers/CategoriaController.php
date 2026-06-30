<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    
    public function index(): View
    {
        
        $categorias = Categoria::orderBy('nome', 'asc')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('categorias.create');
    }

    /**
     * Grava uma nova categoria no banco.
     */
    public function store(CategoriaRequest $request): RedirectResponse
    {
        Categoria::create($request->validated());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição (Usa Route Model Binding).
     */
    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Atualiza a categoria no banco (Usa Route Model Binding).
     */
    public function update(CategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria do banco (Usa Route Model Binding).
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        // Regra de integridade: Não excluir se houver ativos vinculados
        if ($categoria->ativos()->exists()) {
            return redirect()->route('categorias.index')
                ->with('error', 'Não é possível excluir esta categoria porque existem ativos vinculados a ela.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}