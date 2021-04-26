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

Route::get('/', function () {
    return redirect('/struct');
});

Route::get('struct', 'StructController@index');

Route::get('struct/{id}', 'StructController@show');

Route::post('struct/{id}/edit', 'StructController@edit');

Route::post('struct/{id}/delete', 'StructController@delete');

Route::post('struct/{id}/create', 'StructController@create');


