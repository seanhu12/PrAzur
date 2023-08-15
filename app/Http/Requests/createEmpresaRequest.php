<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createEmpresaRequest extends FormRequest
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
			'rut' => 'required|unique:empresas,rut',
			'mail' => 'unique:empresas,mail|nullable',
        ];
    }
}

