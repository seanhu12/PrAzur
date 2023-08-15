<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createNotebookRequest extends FormRequest
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
            'fecha_adquisicion' => 'required:notebooks,fecha_adquisicion',
            'marca' => 'required:notebooks,marca',
        ];
    }
}

