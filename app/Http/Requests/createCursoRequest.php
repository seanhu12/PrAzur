<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createCursoRequest extends FormRequest
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
			'nombre_venta' => 'required|unique:cursos,nombre_venta',
            'codigo_sence' => 'unique:cursos,codigo_sence|nullable',
            'nombre_sence' => 'unique:cursos,nombre_sence|nullable',
        ];
    }
}

