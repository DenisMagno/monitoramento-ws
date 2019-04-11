<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return response()->json(['message' => 'Monitoramento API', 'status' => 'Connected']);
});

Route::get('/responsaveis/{id}', "ResponsavelController@show");
Route::post('/responsaveis', "ResponsavelController@store");
Route::put('/responsaveis/{id}/token', "ResponsavelController@updateToken");
Route::post('/responsaveis/{id}/idosos', "ResponsavelController@storeIdoso");

Route::post('/idosos/{id}/notificacoes', "IdosoController@storeNotificacao");
Route::get('/idosos/{id}', "IdosoController@show");

Route::get('/notificacoes/{id}', "NotificacaoController@show");