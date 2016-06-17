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
//登录注册登出
Route::get('login', [
    'as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login', [
    'middleware' => 'guest', 'uses' => 'LoginController@loginPost']);
Route::get('logout', [
    'middleware' => 'auth', 'as' => 'logout', 'uses' => 'LoginController@logout']);
Route::get('register', [
    'as' => 'register', 'uses' => 'RegisterController@index']);
Route::post('register', 'RegisterController@postRegister');

//分类管理
Route::get('stock', [
    'as' => 'stock', 'uses' => 'StockController@index']);
Route::resource('stock/category/delete', 'CategoryController@destroy');
Route::get('stock/category/edit/{id}', 'CategoryEditController@index');
Route::post('stock/category/edit', 'CategoryEditController@modifyCategory');
Route::get('stock/category/add', [
    'as' => 'addca', 'uses' => 'CategoryController@getAdd']);
Route::post('stock/category/add', 'CategoryController@postAdd');

//商品管理
Route::get('stock/commodity', [
    'as' => 'stkcom', 'uses' => 'CommodityController@index']);
Route::resource('stock/commodity/delete', 'CommodityController@destroy');

Route::get('stock/commodity/edit/{id}', 'CommodityEditController@index');
Route::post('stock/commodity/edit', 'CommodityEditController@modifyCommodity');
Route::get('stock/commodity/add', [
    'as' => 'addcom', 'uses' => 'CommodityController@getAdd']);
Route::post('stock/commodity/add', 'CommodityController@postAdd');

//库存管理
Route::get('stock/check', [
    'as' => 'check', 'uses' => 'StockController@check']);
Route::get('stock/show', [
    'as' => 'show', 'uses' => 'StockController@show']);
Route::get('stock/correct', [
    'as' => 'correct', 'uses' => 'StockController@getCorrect']);
Route::post('stock/correct', 'StockController@postCorrect');
Route::get('stock/inform', [
    'as' => 'less', 'uses' => 'StockController@getInform']);

//客户管理
Route::get('sale', [
    'as' => 'sale', 'uses' => 'SaleController@getClient']);
Route::get('sale/client/add', [
    'as' => 'addclient', 'uses' => 'SaleController@getAddclient']);
Route::post('sale/client/add', 'SaleController@addClient');
Route::post('sale/client/find', 'SaleController@findClient');
Route::resource('sale/client/delete', 'ClientController');
Route::get('sale/client/edit/{id}', 'ClientController@index');
Route::post('sale/client/edit', 'ClientController@modifyClient');

//进货管理
Route::get('sale/import', [
    'as' => 'import', 'uses' => 'SaleController@getImports']);
Route::get('sale/import/add', [
    'as' => 'addimports', 'uses' => 'SaleController@getAddImports']);
Route::post('sale/import/add', 'SaleController@addImports');
Route::post('sale/import/find', 'SaleController@findImports');
Route::get('sale/import/show/{id}', 'SaleController@showImportDetail');

//销售管理
Route::get('sale/export', [
    'as' => 'export', 'uses' => 'SaleController@getExports']);
Route::get('sale/export/add', [
    'as' => 'addexports', 'uses' => 'SaleController@getAddExports']);
Route::post('sale/export/add', 'SaleController@addExports');
Route::post('sale/export/find', 'SaleController@findExports');
Route::get('sale/export/show/{id}', 'SaleController@showExportDetail');

