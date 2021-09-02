<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserFormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user/register');
    }

    /**
     * Salva o usuario no banco de dados
     */
    public function save(CreateUserFormRequest $request)
    {
        $user = $this->createUser($request);

        if ($user->save()) {

            return redirect('/login')->withErrors("Cadastro realizado com sucesso!");
        }
        return redirect('/cadastro')->withErrors("Erro ao cadastrar email");
    }

    /**
     * Cria o model do usuario
     */
    private function createUser(CreateUserFormRequest $request): User
    {
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = Hash::make($request->user_password);

        return $user;
    }
}
