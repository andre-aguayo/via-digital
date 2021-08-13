<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColumnFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "column_name" => "required",
            "column_position" => ["required", "integer"],
            "workboard_id" => ["required", "integer"],
        ];
    }

    public function messages()
    {
        return [
            'column_name.required' => 'O campo nome é obrigatório',
            'column_position.required' => 'O campo posiçao é obrigatório',
            'column_position.integer' => 'O campo posiçao deve ser um numero valido',
            'workboard_id.required' => 'O campo workboard id é obrigatório',
            'workboard_id.integer' => 'O campo workboard id deve ser um numero valido',
        ];
    }
}
