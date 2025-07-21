<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'documento' => [
                'required',
                'cpf_ou_cnpj',
                'unique:fornecedors,documento',
            ],
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string|max:255',
        ];
    }
}
