<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardFormRequest extends FormRequest
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
            "card_description" => "required",
            "card_position" => ["required", "integer"],
            "card_id" => ["required", "integer"],
        ];
    }

    public function messages()
    {
        return [
            'card_description.required' => 'O campo descricao é obrigatório',
            'card_position.required' => 'O campo posiçao é obrigatório',
            'card_position.integer' => 'O campo posiçao deve ser um numero valido',
            'card_id.required' => 'O campo card id é obrigatório',
            'card_id.integer' => 'O campo card id deve ser um numero valido',
        ];
    }
}
