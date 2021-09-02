<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkboardController;
use Illuminate\Support\Facades\Route;

/**
 * Grupo de rotas permitidas apenas para usuarios logados
 */
Route::group(['middleware' => 'auth'], function () {

    /**
     * Mostra o dashboard do usuario
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Rota para criar novo quadro de trabalho
     */
    Route::post('/requisitar-novo-quadro-de-trabalho', [WorkboardController::class, 'create']);

    /**
     * Mostra o quadro de trabalho e seus atriutos
     */
    Route::get('/quadro-de-trabalho/{workboard_id}/{workboard_name}', [WorkboardController::class, 'index'])->name('workboard');
});

/**
 * Rota para a pagina de login
 */
Route::get('/login',  [LoginController::class, 'index'])->name('login');

/**
 * Rota paralogar o usuario
 */
Route::post('/requisitar-login', [LoginController::class, 'login']);

/**
 * Rota para a pagina de cadastro
 */
Route::get('/cadastro', [UserController::class, 'index'])->name('cadastro');

/**
 * Rota para a pagina de cadastro
 */
Route::post('/requisitar-cadastro', [UserController::class, 'save']);
