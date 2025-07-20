<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFornecedorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('fornecedor') ? $this->route('fornecedor')->id : null;
        return [
            'nome' => 'sometimes|required|string|max:255',
            'documento' => [
                'sometimes',
                'required',
                'cpf_ou_cnpj',
                'unique:fornecedores,documento,' . $id
            ],
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string|max:255',
        ];
    }
}
