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

Route::get('/shopping-list', 'ShoppingListController@index');
Route::get('/shopping-list/uncompleted', 'ProductController@getUnCompletedProducts');
Route::put('/shopping-list/update/{id}', 'ProductController@update');
Route::post('/shopping-list/create', 'ProductController@store');
Route::get('/products', 'ProductController@index');
