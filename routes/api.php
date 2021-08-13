<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Grupo de rotas permitidas apenas para usuarios logados
 */
Route::group(['middleware' => 'auth'], function () {

    /**
     * Mostra o dashboard do usuario
     */
    Route::get('/', function () {
        return view('welcome');
    });
});

/**
 * Rota para a pagina de login
 */
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::resource('login', LoginController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
