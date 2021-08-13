<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkboardFormRequest;
use App\Models\Workboard;
use Illuminate\Support\Facades\DB;

class WorkboardController extends Controller
{
    public function create(WorkboardFormRequest $request)
    {
        DB::beginTransaction();
        $workboard = Workboard::create(['name' => $request->workboard_name]);

        $this->createUserWorkboardAccess($workboard);
        $msg = 'Cadastrado com sucesso!';

        DB::commit();

        return redirect('/')->withErrors($msg);
    }

    private function createUserWorkboardAccess(Workboard $workboard)
    {
        $userWorkboardAccessController = new UserWorkboardAccessController();

        $userWorkboardAccessController->create($workboard);
    }

    public function findWorkboardOfWorkboardAccess(int $workboardId)
    {
        return Workboard::find(['id' => $workboardId]);
    }
}
