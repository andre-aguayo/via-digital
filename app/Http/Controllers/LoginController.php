<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
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
        return redirect()->back()->withInput()->withErrors(['Os dados informados são incorretos!']);
    }
}
