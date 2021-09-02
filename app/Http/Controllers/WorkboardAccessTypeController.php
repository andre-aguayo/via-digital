<?php

namespace App\Http\Controllers;

use App\Models\WorkboardAccessType;

class WorkboardAccessTypeController extends Controller
{
    /**
     * Verifica o tipo de acesso em q o usuario possui acesso ao quadro de trabalho indicado
     */
    public function verifyAccessType(int $accessId)
    {
        return WorkboardAccessType::where(['id' => $accessId])->first();
    }
}
