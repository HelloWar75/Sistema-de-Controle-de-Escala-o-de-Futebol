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

Route::get('/reports/partidas_disputadas', 'ReportsController@report_partidas_disputadas');
Route::get('/reports/escalacoes_por_atetlas', 'ReportsController@report_per_athlete');