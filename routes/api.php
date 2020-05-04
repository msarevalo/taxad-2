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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notificaciones/{id}/alertas', 'ApiController@notificaciones');

Route::get('/notificaciones/{id}/leidas', 'ApiController@leidas');

Route::get('/notificaciones/{id}/porLeer', 'ApiController@porLeer');

Route::get('/encriptar/{pass}', 'ApiController@encrip');

Route::get('/categoria', 'ApiController@categorias');

Route::get('categoria/{id}/descripciones', 'ApiController@descripciones');

Route::get('/menus/', 'ApiController@menus');

Route::get('/cantidades/{id}/{inicio?}/{fin?}', 'ApiController@cantidades');

Route::get('/gastos/{id}/{inicio?}/{fin?}', 'ApiController@gastos');