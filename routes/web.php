<?php

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
Route::get('/login', function () {
    return view('login');
})->name('login');