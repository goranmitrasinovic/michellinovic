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
Route::put('/shopping-list/product/{id}', 'ProductController@completePurchase');
Route::put('/shopping-list/edit-product/{id}', 'ProductController@update');
Route::put('/shopping-list/clear-list', 'ProductController@clearShoppingListOfProducts');

Route::post('/product/create', 'ProductController@store');
Route::get('/products', 'ProductController@index');

Route::get('/users', 'UserController@index');

Route::post('/competitions/create', 'CompetitionController@create');
Route::get('/competitions', 'CompetitionController@index');
