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

Route::get('/all','CustomersController@all');
Route::get('/lcalc','PagesController@lcalc');
Route::get('/stats','PagesController@stats');


Route::get('/','CustomersController@index');
Route::get('/create','CustomersController@create');
Route::get('/{id}','CustomersController@show');
Route::post('/','CustomersController@store');
Route::match(['put','patch'],'/{id}','CustomersController@update');
Route::delete('/{id}','CustomersController@destroy');
Route::get('/{id}/edit','CustomersController@edit');


Route::get('/pay/{id}','PaymentsController@create');
Route::post('/pay','PaymentsController@store');
Route::get('/pay/{id}/edit','PaymentsController@edit');
Route::put('/pay/{id}','PaymentsController@update');
Route::delete('/pay/{id}','PaymentsController@destroy');

