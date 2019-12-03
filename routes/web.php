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

//Faz com que o router do Laravel mande todas as rotas para o vue-router
//Provavelmente vai ter que ser modificado por causa da API. We'll see.
Route::get('/{vue_capture?}', function () {
    return view('vue/index');
})->where('vue_capture', '[\/\w\.-]*');

