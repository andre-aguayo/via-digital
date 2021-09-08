<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        //primeiro desloga o usuario antes de renderizar a view
        $this->logout();

        return view('user/login');
    }

    public function login(LoginFormRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->user_email,
                'password' => $request->user_password
            ],
            true
        ) === true) {
            return redirect('/');
        }
        return redirect()->back()->withInput()->with('error', 'Os dados informados são incorretos!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Deslogado com sucesso.');
    }
}
