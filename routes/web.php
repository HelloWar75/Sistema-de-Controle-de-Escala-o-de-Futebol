<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/team', 'TeamController')->middleware('auth');
Route::resource('/athlete', 'AthleteController')->middleware('auth');
Route::resource('/escalation', 'EscalationController')->middleware('auth');
Route::get('/reports', 'ReportsController@index')->name('reports.index')->middleware('auth');
Route::get('/reports/2', 'ReportsController@report2')->name('reports.partidas_disputadas')->middleware('auth');
Route::get('/reports/2/{id}', 'ReportsController@report2_selected')->name('reports.partidas_disputadas_selecionada')->middleware('auth');