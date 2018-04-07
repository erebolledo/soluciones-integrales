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

Route::post('/account/store', 'AccountController@store');
Route::post('/account/auth', 'AccountController@auth');
Route::get('/account/exist/{email}', 'AccountController@exist');
Route::get('/account/get/{id}', 'AccountController@get');
Route::get('/admin/orders', 'AdminController@orders');
Route::post('/admin/parse-coronado', 'AdminController@parseCoronado');
Route::get('/order/change-status/{id}', 'OrderController@changeStatus');
Route::get('/account/test', 'AccountController@test');

Route::get('/account/get-dollar-value', 'AccountController@getDollarValue');


