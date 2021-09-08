<?php

namespace App\Http\Controllers;

use App\Models\UserWorkboardAccess;
use App\Models\WorkboardAccessType;

class VerifyAccessControllerToWorkboard extends Controller
{
    /**
     * Caso o usuario possua acesso ao quadro de trabalho recupera o tipo de acesso
     * 
     * @param int $workboardId O id do quadro de trabalho requisitado
     * @param int $userId O usuario em q se quer vefiricar acesso ao quadro de trabalho
     * 
     * @return UserWorkboardAccess se pertencer ao usuario
     * @return bool false caso nao pertença ao usuario
     */
    public function verifyUserAccess(int $workboardId, int $userId): UserWorkboardAccess|bool
    {
        $workboardAccess = $this->requestUserWorkboardAccess($workboardId, $userId);

        if ($workboardAccess !== NULL) {
            $accessType = $this->requestWorkboardAccessType($workboardAccess->workboard_acess_type_id);
            $workboardAccess->access_type = $accessType;

            return $workboardAccess;
        }
        return false;
    }

    /**
     * Recupera o acesso caso o usuario possua
     * Se nao possuir retorna nullo
     * 
     * @param int $workboardId O id do quadro de trabalho requisitado
     * @param int $userId O usuario em q se quer vefiricar acesso ao quadro de trabalho
     * 
     *  @return UserWorkboardAccess se pertencer ao usuario
     * @return bool false caso nao pertença ao usuario
     */
    private function requestUserWorkboardAccess(int $workboardId, int $userId): UserWorkboardAccess|NULL
    {
        $workboardAccessTypeController = new UserWorkboardAccessController();
        return $workboardAccessTypeController->requestUserAccessToWorkboard($workboardId, $userId);
    }

    /**
     * Recupera o tipo de acesso caso possua
     *
     * @param int $workboardId O id do quadro de trabalho requisitado
     * @param int $userId O usuario em q se quer vefiricar acesso ao quadro de trabalho
     * 
     *  @return WorkboardAccessType se pertencer ao usuario
     * @return bool false caso nao pertença ao usuario
     */
    private function requestWorkboardAccessType(int $workboardAccessTypeId): WorkboardAccessType|NULL
    {
        $workboardAccessType = new WorkboardAccessTypeController();
        return $workboardAccessType->verifyAccessType($workboardAccessTypeId);
    }
}
