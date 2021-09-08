<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkboardFormRequest;
use App\Models\Card;
use App\Models\Column;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Workboard;

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

        return redirect('/')->with('error', 'Você nao possui acesso ou o quadro de trabalho nao existe!');
    }

    /**
     * Cria o quadro de trabalho e o acesso ao usuario para o quado de trabalho
     */
    public function store(WorkboardFormRequest $request)
    {
        DB::beginTransaction();
        $workboard = Workboard::create(['name' => $request->workboard_name]);
        $this->storeUserWorkboardAccess($workboard);
        DB::commit();

        return redirect('/')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Cria o acesso ao quadro de trabalho para o usuario
     */
    private function storeUserWorkboardAccess(Workboard $workboard)
    {
        $userWorkboardAccessController = new UserWorkboardAccessController();
        $userWorkboardAccessController->store($workboard);
    }

    /**
     * Busca um workboard especifico e seus componentes
     */
    private function requestWorkboardAndRelactions(int $workboardId)
    {
        return Workboard::find($workboardId)->with('columns.cards');
    }

    /** 
     * Busca informaçoes do workboard caso o usuario possua acesso
     * 
     * @param int $workboardId O id do quadro de trabalho requisitado
     * @param int $userId O usuario em q se quer vefiricar acesso ao quadro de trabalho
     * 
     * @return Workboard se o usuario possuir acesso ao quadro de trabalho
     * @return false caso o usuario nao possua acesso
     */
    private function requestWorkboardAccess(int $workboardId, int $userId): Workboard|bool
    {
        $verifyWorboardAccess = new VerifyAccessControllerToWorkboard();
        return $verifyWorboardAccess->verifyUserAccessToWorkboard($workboardId, $userId);
    }

    /**
     * Recupera as informaçoes do workboard atraves da doluna
     * @param int $columnId chave primaria da coluna
     * @return Workboard 
     */
    public function requestWorkboardByColumn(int $columnId): Workboard|NULL
    {
        return Column::find($columnId)->workboard;
    }

    /**
     * Recupera as informaçoes do workboard atraves do cartao
     * @param int $columnId chave primaria do cartao
     * @return mixed
     */
    public function requestWorkboardByCard(int $cardId): Workboard | NULL
    {
        return Card::find($cardId)->column->workboard;
    }
}
