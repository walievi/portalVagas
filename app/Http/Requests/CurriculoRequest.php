<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'curriculo' => 'required|file|mimes:pdf',
        ];
    }

    public function messages(){
        return [
        'curriculo.mimes'       => 'O arquivo de currículo enviado deve ser no formato PDF. Por favor, tente novamente.',
        ];
    }
}
