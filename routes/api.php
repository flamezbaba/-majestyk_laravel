<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


$version = "v1";

Route::group(['middleware' => 'cors', 'middleware' => 'auth:api', 'prefix' => "$version"], function() {

	Route::get('tokens', "Api\Current\AccessController@index");
	Route::post('tokens/create', "Api\Current\AccessController@create");

	Route::post('users/login', "Api\Current\UserController@login");
	Route::post('users/register', "Api\Current\UserController@register");
	Route::post('users/single', "Api\Current\UserController@single");
	Route::post('users/save_picture', "Api\Current\UserController@save_picture");
	
});

Route::any('failed', "Api\Current\TestController@auth_failed")->name("failed");