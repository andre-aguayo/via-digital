<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkboardFormRequest extends FormRequest
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
            "workboard_name" => "required"
        ];
    }

    public function messages()
    {
        return [
            'workboard_name.required' => 'O campo nome é obrigatório'
        ];
    }
}
