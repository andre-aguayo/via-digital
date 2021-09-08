<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Workboard;

class VerifyAccessToCard extends Controller
{
    /**
     * Verifica o acesso ao cartao em dois passos: 
     *      1-Verifica se o cartao realmente pertence ao quadro de trabalho em questao
     *      2-Verifica se o usuario possui acesso ao quadro de trabalho em q o cartao pertence
     *
     * @param int $workboardId o id na url do quadro de trabalho em uso
     * @param int $cardId O cartao verificado
     * 
     * @return true se acesso concedido
     * @return false se acesso negado
     */
    public function verifyAccess(int $workboardId, int $cardId)
    {
        $workboardParent = $this->requestWorkboard($cardId);
        //Compara se o workboard informado realmente pertence ao cartao informado
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
    public function requestWorkboard(int $cardId): Workboard | NULL
    {
        $workboardController = new WorkboardController();
        return $workboardController->requestWorkboardByCard($cardId);
    }
}
