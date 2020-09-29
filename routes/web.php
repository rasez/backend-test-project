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
    return redirect(route('dashboard'));
});

Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@register')->name('register');
    Route::post('register', 'RegisterController@store')->name('post.register');
    Route::get('verify-email/{token}', 'RegisterController@verifyEmail')->name('verify-email');
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@authenticate')->name('post.login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('forget-password', 'ResetPasswordController@getEmail')->name('forget-password');
    Route::post('forget-password', 'ResetPasswordController@postEmail')->name('post.forget-password');
    Route::get('reset-password/{token}', 'ResetPasswordController@getPassword')->name('reset-password');
    Route::post('reset-password', 'ResetPasswordController@updatePassword')->name('post.reset-password');
    Route::get('/login/{provider}', 'LoginController@redirectToProvider')->name('social.login');
    Route::get('/login/{provider}/callback', 'LoginController@handleProviderCallback')->name('social.callback');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('wallets', 'WalletController');
    Route::middleware(['wallet'])->group(function () {
        Route::get('dashboard', 'WalletController@dashboard')->name('dashboard', 'store');
        Route::resource('wallets.transactions', 'TransactionController')->only([
            'index', 'create', 'store'
        ]);
    });
});

