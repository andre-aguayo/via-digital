<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkboardFormRequest;
use App\Models\Workboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkboardController extends Controller
{
    /**
     * Após verificar o acesso ao quadro de trabalho recupera as olunas e cards
     */
    public function index(int $workboardId, string $workboardName)
    {

        $workboardAccess = $this->requestWorkboardAccess($workboardId, Auth::user()->id);

        if ($workboardAccess !== false) {
            $workboard = $this->requestWorkboardAndRelactions($workboardId);

            return view('workboard/index', ['workboardName' => $workboardName, 'workboard' => $workboard]);
        }

        return redirect('/')->withErrors('Você nao possui acesso ou o quadro de trabalho nao existe!');
    }

    /**
     * Cria o quadro de trabalho e o acesso ao usuario para o quado de trabalho
     */
    public function create(WorkboardFormRequest $request)
    {
        DB::beginTransaction();
        $workboard = Workboard::create(['name' => $request->workboard_name]);

        $this->createUserWorkboardAccess($workboard);
        $msg = 'Cadastrado com sucesso!';

        DB::commit();

        return redirect('/')->withErrors($msg);
    }

    /**
     * Cria o acesso ao quadro de trabalho para o usuario
     */
    private function createUserWorkboardAccess(Workboard $workboard)
    {
        $userWorkboardAccessController = new UserWorkboardAccessController();

        $userWorkboardAccessController->create($workboard);
    }

    /**
     * Busca um workboard especifico e seus componentes
     */
    private function requestWorkboardAndRelactions(int $workboardId)
    {
        return Workboard::where(['id' => $workboardId])->with('columns.cards')->get();
    }

    /**
     * Busca informaçoes do workboard caso o usuario possua acesso
     * @return false caso o usuario nao possua acesso ou o workboard caso possua acesso
     */
    private function requestWorkboardAccess(int $workboardId, int $userId)
    {
        $verifyWorboardAccess = new VerifyAccessControllerToWorkboard();

        return $verifyWorboardAccess->verifyUserAccessToWorkboard($workboardId, $userId);
    }
}
