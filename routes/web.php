<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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
Route::get('/login',  [LoginController::class, 'index'])->name('login');

/**
 * Rota paralogar o usuario
 */
Route::post('/requisitar-login', [LoginController::class, 'login']);

/**
 * Rota para a pagina de cadastro
 */
Route::get('/cadastro', function () {
    return view('user/register');
})->name('login');
