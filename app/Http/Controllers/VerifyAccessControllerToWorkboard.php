<?php

namespace App\Http\Controllers;

class VerifyAccessControllerToWorkboard extends Controller
{
    /**
     * Caso o usuario possua acesso ao quadro de trabalho recupera o tipo de acesso
     */
    public function verifyUserAccessToWorkboard(int $workboardId, int $userId)
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
     */
    private function requestUserWorkboardAccess(int $workboardId, int $userId)
    {
        $workboardAccessTypeController = new UserWorkboardAccessController();

        return $workboardAccessTypeController->requestUserAccessToWorkboard($workboardId, $userId);
    }

    /**
     * Recupera o tipo de acesso caso possua
     */
    private function requestWorkboardAccessType(int $workboardAccessTypeId)
    {
        $workboardAccessType = new WorkboardAccessTypeController();

        return $workboardAccessType->verifyAccessType($workboardAccessTypeId);
    }
}
