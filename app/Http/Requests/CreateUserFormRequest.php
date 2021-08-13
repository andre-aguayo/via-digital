<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFormRequest extends FormRequest
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
            "user_name" => "required",
            "user_email" => ["required", "email:rfc,dns", "unique:users,email"],
            "user_password" => ["required", "min:8"]
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'O campo nome é obrigatório',
            'user_email.required' => 'O campo email é obrigatório',
            'user_email.email' => 'Formato de email incorreto',
            'user_email.unique' => 'Este email já esta cadastrado',
            'user_password.required' => 'O campo senha é obrigatório',
            'user_password.min' => 'A senha deve conter no minimo 8 caracteres'
        ];
    }
}
