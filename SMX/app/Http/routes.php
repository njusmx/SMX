<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [
    'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login', [
    'middleware' => 'guest', 'uses' => 'LoginController@loginPost']);
Route::get('logout', [
    'middleware' => 'auth', 'as' => 'logout', 'uses' => 'LoginController@logout']);
Route::get('register', [
    'as' => 'register', 'uses' => 'RegisterController@index']);
Route::post('register', 'RegisterController@postRegister');

//stock manager
Route::get('stock', [
    'as' => 'stock', 'uses' => 'StockController@index']);
Route::resource('stock/category/delete', 'CategoryController');
Route::resource('stock/category/edit', 'CategoryEditController');
Route::get('stock/category/add', [
    'as' => 'addca', 'uses' => 'CategoryController@getAdd']);
Route::post('stock/category/add', 'CategoryController@postAdd');
Route::get('stock/check', [
    'as' => 'check', 'uses' => 'StockController@check']);
Route::get('stock/correct', [
    'as' => 'correct', 'uses' => 'StockController@getCorrect']);
Route::post('stock/correct', 'StockController@postCorrect');
Route::get('stock/inform', [
    'as' => 'less', 'uses' => 'StockController@getLess']);
Route::get('stock/inform/more', [
    'as' => 'more', 'uses' => 'StockController@getMore']);

//salesman
Route::get('sale', [
    'as' => 'sale', 'uses' => 'SaleController@getClient']);
Route::get('sale/client/add', [
    'as' => 'addclient', 'uses' => 'SaleController@getAddclient']);
Route::post('sale/client/add', 'SaleController@addClient');
Route::get('sale/client/find', 'SaleController@getfindClient');
Route::post('sale/client/find', 'SaleController@findClient');
Route::resource('sale/client/delete', 'ClientController');
Route::resource('sale/client/edit', 'ClientController');