<?php

namespace App\Http\Controllers;

use App\Models\Workboard;
use App\Models\UserWorkboardAccess;
use Illuminate\Support\Facades\Auth;

class UserWorkboardAccessController extends Controller
{
    /**
     * Cria o tipo de acesso ao quadro de trabalho criado
     */
    public function create(Workboard $workboard)
    {
        $workboardId = $workboard->id;

        $workboard->userWorkboardAccess()->create([
            'user_id' => Auth::user()->id,
            'workboard_id' => $workboardId
        ]);
    }

    /**
     * Recupera os acessos do usuario aos quadros de trabaho
     */
    public function requestAllWorkboardsOfUser(int $userId)
    {
        $userWorkboardAccess =  UserWorkboardAccess::where('user_id', $userId)->with('workboard')->get();

        return $userWorkboardAccess;
    }

    /**
     * recupera o acesso e o tipo de acesso ao quadro de trabalho
     */
    public function requestUserAccessToWorkboard(int $workboardId, int $userId)
    {
        return UserWorkboardAccess::where(['workboard_id' => $workboardId, 'user_id' => $userId])->first();
    }
}
