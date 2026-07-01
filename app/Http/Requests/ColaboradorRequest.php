<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Controlado via Policy nas rotas
    }

    public function rules(): array
    {
        $colaboradorId = $this->route('colaborador') ? $this->route('colaborador')->id : null;

        return [
            'nome'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', 'unique:colaboradores,email,' . $colaboradorId],
            'departamento' => ['required', 'string', 'max:100'],
            'cargo'        => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'         => 'O nome do colaborador é obrigatório.',
            'email.required'        => 'O e-mail é obrigatório.',
            'email.email'           => 'Insira um endereço de e-mail válido.',
            'email.unique'          => 'Este e-mail já está sendo utilizado por outro colaborador.',
            'departamento.required' => 'O departamento é obrigatório.',
            'cargo.required'        => 'O cargo é obrigatório.',
        ];
    }
}