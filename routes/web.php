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

Route::get('/', function() {return view('welcome');});
Route::get('/account/create', function () {return view('account.create');});
Route::post('/account/store', 'AccountController@store');
Route::get('/account/login', function () {return view('account.login');});
Route::get('/account/show/{status?}/', 'AccountController@show');
Route::get('/account/edit', function () {$user = session('user'); return view('account.edit', ['user'=>$user]);});
Route::post('/account/init-session/{token?}', 'AccountController@initSession');
Route::get('/account/forgot', 'AccountController@forgot');
Route::get('/account/logout',  function () {session()->flush(); session()->save(); return view('welcome');});
Route::get('/account/token-login/{token}/', 'AccountController@tokenLogin');


Route::get('/order/create', 'OrderController@create');
Route::post('/order/store', 'OrderController@store');
Route::get('/order/index/{status?}', 'OrderController@index');

Route::get('/calculate', 'AccountController@calculate');

Route::get('/support', function () {return view('support.support');});

Route::get('/admin', 'AdminController@index');
Route::get('/admin/login', function () {return view('admin.login');});
Route::post('/admin/init-session', 'AdminController@initSession');
Route::get('/admin/id-coronado', function () {return view('admin.idCoronado');});
Route::post('/admin/store-id-coronado', 'AdminController@storeIdCoronado');
Route::get('/admin/logout', 'AdminController@logout');

Route::any('/account/test', 'AccountController@test');
Route::any('/email', function () {$user = session('user'); return view('email.welcome', ['user'=>$user]);});

Route::get('/registry/{id?}', function ($id='-1') {return view('registry', ['id'=>$id]);});
Route::get('/show', function () {return view('show');});
Route::get('/logout', 'AccountController@logout');
Route::post('/init-session', 'AccountController@initSession');
Route::post('/order-save', 'AccountController@orderSave');
Route::get('/account/pack/new', 'AccountController@packNew');
Route::get('/account/pack/{pack}/{sent?}', 'AccountController@account');
Route::get('/account', 'AccountController@account');
Route::get('/account/create', function () {return view('account.create');});
Route::get('/message', function () {return view('message');});
//Route::post('/auth', 'AccountController@auth');
