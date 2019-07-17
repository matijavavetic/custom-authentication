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

Route::get('home', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function() {
    Route::get('register', 'RegisterController@show');
    Route::post('register', 'RegisterController@register');

    Route::get('confirmation/{token}', 'VerificationController@show');
    Route::post('confirmation/{token}', 'VerificationController@confirm');

    Route::get('login', 'LoginController@show');
    Route::post('login', 'LoginController@login');

    Route::get('password/reset', 'ResetPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ResetPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
    Route::post('password/reset/{token}', 'ResetPasswordController@reset');
});

Route::post('logout', 'LoginController@logout')->middleware('auth');

