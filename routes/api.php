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

Route::middleware('auth:api')->get('/user', 'UserControllerAPI@authenticatedUser');
Route::post('login', 'AuthControllerAPI@login');
Route::middleware('auth:api')->post('logout','AuthControllerAPI@logout');
Route::post('register','AuthControllerAPI@register');
Route::middleware('auth:api')->get('movements', 'MovementControllerAPI@index');
Route::get('wallets', 'WalletControllerAPI@index');
// Route::middleware('auth:api')->get('users', 'UserControllerAPI@index'); DEV_ONLY needs to be checked for usefulness
