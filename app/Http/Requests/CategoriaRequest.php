<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Define as regras de validação aplicadas à requisição.
     */
    public function rules(): array
    {
        // Se for uma atualização, ignora o ID atual na regra de unicidade
        $categoriaId = $this->route('categoria') ? $this->route('categoria')->id : null;

        return [
            'nome' => [
                'required',
                'string',
                'max:100',
                'unique:categorias,nome,' . $categoriaId,
            ],
            'descricao' => ['nullable', 'string', 'max:255'],
        ];
    }

    
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 100 caracteres.',
            'nome.unique' => 'Já existe uma categoria cadastrada com este nome.',
            'descricao.max' => 'A descrição não pode ter mais de 255 caracteres.',
        ];
    }
}