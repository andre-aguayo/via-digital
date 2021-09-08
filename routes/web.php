<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
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
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    /**
     * Rota para criar novo quadro de trabalho
     */
    Route::post('/quadro-de-trabalho/armazenar', [WorkboardController::class, 'store'])->name('workboard.store');

    /**
     * Mostra o quadro de trabalho e seus atriutos
     */
    Route::get('/quadro-de-trabalho/{workboard_id}/{workboard_name}', [WorkboardController::class, 'index'])->name('workboard.index');

    /**
     * Grupo de rotas para as colunas
     */
    Route::group(['prefix' => 'coluna'], function () {
        // Cria nova coluna na area de trabalho
        Route::post('/criar', [ColumnController::class, 'create'])->name('column.create');

        //Altera atributos da coluna na area de trabalho
        Route::post('/editar', [ColumnController::class, 'update'])->name('column.edit');

        //Remove coluna na area de trabalho
        Route::post('/remover', [ColumnController::class, 'delete'])->name('column.destroy');
    });

    /**
     * Grupo de rotas para as colunas
     */
    Route::group(['prefix' => 'cartao'], function () {
        // Cria novo cartao na area de trabalho
        Route::post('/criar', [CardController::class, 'create'])->name('card.create');

        //Altera atributos do cartao na area de trabalho
        Route::post('/editar', [CardController::class, 'update'])->name('card.edit');

        //Remove cartao na area de trabalho
        Route::post('/remover', [CardController::class, 'delete'])->name('card.destroy');
    });
});

/**
 * Rota para a pagina de login
 */
Route::get('/login',  [LoginController::class, 'index'])->name('login');

/**
 * Rota paralogar o usuario
 */
Route::post('/logar', [LoginController::class, 'login'])->name('logar');

/**
 * Rota para a pagina de cadastro
 */
Route::get('/usuario/cadastro', [UserController::class, 'index'])->name('user.create');

/**
 * Rota para a pagina de cadastro
 */
Route::post('/usuario/criar', [UserController::class, 'store'])->name('user.store');
