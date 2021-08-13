<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userWorkboardAccess  = $this->requestAllUserWorkboardAccessess();
        
        return view('/index', ['userWorkboardAccess' => $userWorkboardAccess]);
    }

    /**
     * Recupera os acessos e tipo de acessos dos quadros de trabalho do usuario
     */
    private function requestAllUserWorkboardAccessess()
    {
        $userWorkboardAccessController = new UserWorkboardAccessController();

        return $userWorkboardAccessController->requestAllWorkboardsOfUser(Auth::user()->id);
    }
}
