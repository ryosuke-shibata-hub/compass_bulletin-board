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

Route::group(['middleware' => ['guest']], function() {

    Route::get('/', function () {
    return view('welcome');
});

    Route::namespace('Auth')->group(function() {
        Route::namespace('Login')->group(function() {
            Route::get('/login','LoginController@loginForm')->name('login.form');
            Route::post('login','LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function() {
           Route::get('/register/form','RegisterController@register')->name('register.form');
           Route::post('/register','RegisterController@registerForm')->name('register');
           Route::get('/register/added','RegisterController@registerAdded')->name('register.added');

    });

});
});
