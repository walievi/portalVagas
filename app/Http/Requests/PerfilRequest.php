<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
            'endereco.cep'    => 'nullable|integer|size:8',
            'endereco.pais'   => 'nullable|max:255',
            'endereco.estado' => 'nullable|max:255',
            'endereco.cidade' => 'nullable|max:255',
            'endereco.bairro' => 'nullable|max:255',
            'endereco.rua'    => 'nullable|max:255',
        ];
    }

    public function messages()
    {

        return [
            'endereco.cep.size'       => 'O CEP deve ter exatamente 8 caracteres.',
            'endereco.cep.integer'    => 'Este CEP é inválido.',
            'endereco.pais.max'       => 'O nome do país não pode exceder 255 caracteres.',
            'endereco.estado.max'     => 'O nome do estado não pode exceder 255 caracteres.',
            'endereco.cidade.max'     => 'O nome da cidade não pode exceder 255 caracteres.',
            'endereco.bairro.max'     => 'O nome do bairro não pode exceder 255 caracteres.',
            'endereco.rua.max'        => 'O nome da rua não pode exceder 255 caracteres.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => $this->cpf == null ? null : preg_replace('/[^0-9]/', '', $this->cpf),
        ]);
    }
}
