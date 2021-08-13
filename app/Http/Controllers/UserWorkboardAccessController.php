<?php

namespace App\Http\Controllers;

use App\Models\Workboard;
use App\Models\UserWorkboardAccess;
use Illuminate\Support\Facades\Auth;

class UserWorkboardAccessController extends Controller
{
    public function create(Workboard $workboard)
    {
        $workboardId = $workboard->id;

        $workboard->userWorkboardAccess()->create([
            'user_id' => Auth::user()->id,
            'workboard_id' => $workboardId
        ]);
    }

    public function requestAllWorkboardsOfUser(int $userId)
    {
        $userWorkboardAccessController =  UserWorkboardAccess::where('user_id', $userId)->get();

        return $this->requestWorkboardsAccess($userWorkboardAccessController);
    }

    /**
     * Recupera os quadros de trabalho em q o usuario possui a cesso
     */
    private function requestWorkboardsAccess($userWorkboardAccessControllers)
    {
        $userWorkboardAccess = [];

        $workboardController = new WorkboardController();

        foreach ($userWorkboardAccessControllers as $userWorkboardAccessController) {
            $workboardName = $workboardController->findWorkboardOfWorkboardAccess($userWorkboardAccessController->id)[0]->name;

            $userWorkboardAccessController->workboard_name = $workboardName;

            $userWorkboardAccess[] = $userWorkboardAccessController;
        }
        return $userWorkboardAccess;
    }
}
