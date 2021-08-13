<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user/register');
    }

    public function save(CreateUserFormRequest $request)
    {
        $user = $this->createUser($request);

        if ($user->save()) {

            return redirect('/login');
        }
        return redirect('/cadastro')->withErrors("Erro ao cadastrar email");
    }

    private function createUser(CreateUserFormRequest $request): User
    {
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = Hash::make($request->user_password);

        return $user;
    }
}
