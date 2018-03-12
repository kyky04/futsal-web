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

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/user', function (Request $request) {
    	return $request->user();
    });
  });


Route::resource('lapangan', 'LapanganAPIController');

Route::resource('team', 'TeamAPIController');
Route::post('teams', 'TeamAPIController@store');
Route::get('teams-lapang/{id_lapang}', 'TeamAPIController@getByLapang');
Route::get('myteam/{id_user}', 'TeamAPIController@myteam');

Route::resource('jadwal', 'JadwalAPIController');
Route::get('jadwal-team/{id_team}', 'JadwalAPIController@showByTeam');

Route::resource('pemain', 'PemainAPIController');
Route::get('pemain-team/{id_team}', 'PemainAPIController@showByTeam');

Route::resource('kompetisi', 'KompetisiAPIController');

Route::resource('turnamen', 'TurnamenAPIController');

Route::resource('pertandingan', 'PertandinganAPIController');
Route::get('versus/{id_team}', 'PertandinganAPIController@pertandingan');