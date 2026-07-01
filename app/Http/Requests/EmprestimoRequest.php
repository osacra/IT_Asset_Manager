<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ativo_id'       => ['required', 'exists:ativos,id'],
            'colaborador_id' => ['required', 'exists:colaboradores,id'],
            'data_retirada'  => ['required', 'date', 'before_or_equal:today'],
            'observacoes'    => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'ativo_id.required'       => 'Selecione um ativo para empréstimo.',
            'colaborador_id.required' => 'Selecione o colaborador que receberá o ativo.',
            'data_retirada.required'  => 'A data de retirada é obrigatória.',
        ];
    }
}