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

Route::get('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('addplayer', 'AuthenticationController@addplayer');
Route::get('getallplayers', 'AuthenticationController@getAllPlayers');
Route::post('addtraining', 'AuthenticationController@addtraining');
Route::get('getalltrainings', 'AuthenticationController@getalltrainings');
Route::get('getuser', 'AuthenticationController@getuser');
