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
Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1',], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'JwtController@login');
        Route::post('register', 'JwtController@register');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'JwtController@logout');
        });
    });

    Route::get('products', 'ProductController@index');
});
