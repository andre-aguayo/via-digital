<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Workboard;

class VerifyAccessToColumn extends Controller
{
    /**
     * Verifica o acesso a coluna em dois passos: 
     *      1-Verifica se a coluna realmente pertence ao quadro de trabalho em questao
     *      2-Verifica se o usuario possui acesso ao quadro de trabalho em q a coluna pertence
     *
     * @param int $workboardId o id na url do quadro de trabalho em uso
     * @param int $columnId A coluna verificada
     * 
     * @return true se acesso concedido
     * @return false se acesso negado
     */
    public function verifyAccess(int $workboardId, int $columnId): bool
    {
        $workboardParent = $this->requestWorkboard($columnId);
        //Compara se o workboard informado realmente pertence a coluna informada
        if ($workboardParent->id === $workboardId) {
            $verifyAcceessToWorkboard = new VerifyAccessControllerToWorkboard();
            //verifica se o usuario pertence ao quadro de trabalho
            if ($verifyAcceessToWorkboard->verifyUserAccess($workboardId, Auth::user()->id) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Recupera o workboard da coluna informada para veficaçao
     * @return Workboard
     */
    private function requestWorkboard(int $columnId): Workboard | NULL
    {
        $WorkboardController = new WorkboardController();
        return $WorkboardController->requestWorkboardByColumn($columnId);
    }
}
