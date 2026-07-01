<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Controlado via Policy/Middleware
    }

    public function rules(): array
    {
        $ativoId = $this->route('ativo')?->id;

        return [
            'categoria_id'    => ['required', 'exists:categorias,id'],
            'status_ativo_id' => ['required', 'exists:status_ativos,id'],
            'patrimonio'      => ['required', 'string', 'max:50', 'unique:ativos,patrimonio,' . $ativoId],
            'nome'            => ['required', 'string', 'max:255'],
            'marca'           => ['required', 'string', 'max:100'],
            'modelo'          => ['required', 'string', 'max:100'],
            'numero_serie'    => ['nullable', 'string', 'max:100', 'unique:ativos,numero_serie,' . $ativoId],
            'data_aquisicao'  => ['required', 'date', 'before_or_equal:today'],
            'valor'           => ['required', 'numeric', 'min:0'],
            'localizacao'     => ['required', 'string', 'max:255'],
            'observacoes'     => ['nullable', 'string', 'max:1000'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'patrimonio.required' => 'O número de patrimônio é obrigatório.',
            'patrimonio.unique'   => 'Este número de patrimônio já está cadastrado no sistema.',
            'categoria_id.required' => 'Selecione uma categoria válida.',
            'status_ativo_id.required' => 'Selecione um status válido.',
            'data_aquisicao.before_or_equal' => 'A data de aquisição não pode ser uma data futura.',
        ];
    }
}