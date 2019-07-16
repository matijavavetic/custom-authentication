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
    Route::get('register', 'RegisterController@showRegistrationForm');
    Route::post('register', 'RegisterController@register');
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('confirmation/{token}', 'RegisterController@confirmMailForm');
    Route::post('confirmation/{token}', 'RegisterController@confirmation');
});

Route::post('logout', 'LoginController@logout')->middleware('auth');

