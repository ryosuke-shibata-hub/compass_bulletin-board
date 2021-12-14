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

//ログアウト時の画面
Route::group(['middleware' => ['guest']], function() {

    Route::get('/', function () {
    return view('welcome');
});

    Route::namespace('Auth')->group(function() {
        Route::namespace('Login')->group(function() {
            //ログイン画面
            Route::get('/login','LoginController@loginForm')->name('login.form');
            Route::post('/login','LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function() {
            //登録画面
           Route::get('/register/form','RegisterController@registerForm')->name('register.form');
           Route::post('/register','RegisterController@register')->name('register');
           Route::get('/register/added','RegisterController@registerAdded')->name('register.added');
        });
    });
});
//ログイン時の画面
Route::group(['middleware' => ['auth']],function() {
    //管理者画面
    Route::group(['middleware' => ['can:admin']],function() {
        Route::namespace('Admin')->group(function() {
            Route::namespace('Post')->group(function() {
                //トップページ
                Route::get('/admin/top','PostsController@index')->name('admin.post.index');
            });
        });
    });
    //一般ユーザー画面
    Route::group(['middleware' => ['can:user']],function() {
        Route::namespace('User')->group(function() {
            Route::namespace('Post')->group(function() {
                Route::get('/top','PostsController@index')->name('user.post.index');
                });
            });
        });
    });
