<?php

// ログアウト中のページ
Route::group(['middleware' => ['guest']], function () {
    // ログイン関連の処理
    Route::namespace('Auth')->group(function () {
        Route::namespace('Login')->group(function () {
            // ログイン画面
            Route::get('/login', 'LoginController@loginForm')->name('login.form');
            // ログイン処理
            Route::post('/login', 'LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function () {
            // ユーザー登録画面
            Route::get('/register/form', 'RegisterController@registerForm')->name('register.form');
            // ユーザー登録処理
            Route::post('/register', 'RegisterController@register')->name('register');
            // ユーザー登録完了画面
            Route::get('/register/added', 'RegisterController@registerAdded')->name('register.added');
        });
    });
});

// ログイン中のページ
Route::group(['middleware' => ['auth']], function () {
    // 管理者専用の処理
    Route::group(['middleware' => ['can:admin']], function () {
        Route::namespace('Admin')->group(function () {
            // 掲示板関連の処理
            Route::namespace('Post')->group(function () {
                // カテゴリー一覧画面
                Route::get('/post_category', 'PostController@postCategoryIndex')->name('post_category.index');
                // 新規メインカテゴリー登録処理、メインカテゴリー削除処理
                Route::resource('post_main_category', 'PostMainCategoriesController', ['only' => ['store', 'destroy']]);
                // 新規サブカテゴリー登録処理、サブカテゴリー削除処理
                Route::resource('post_sub_category', 'PostSubCategoriesController', ['only' => ['store', 'destroy']]);
            });
        });
    });
    // ユーザー、管理者共通の処理
    Route::group(['middleware' => ['can:user']], function () {
        Route::namespace('Auth')->group(function () {
            // ログイン関連の処理
            Route::namespace('Login')->group(function () {
                // ログアウトの処理
                Route::get('/logout', 'LoginController@logout')->name('logout');
            });
        });
        // 掲示板関連の処理
        Route::namespace('User')->group(function () {
            Route::namespace('Post')->group(function () {
                // 掲示板一覧ページ表示
                Route::get('/post/index/{category?}', 'PostController@index')->name('post.index');
                // 掲示板投稿処理、編集画面表示、編集処理、削除処理
                Route::resource('post', 'PostController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
                // view数カウント
                // Route::group(['middleware' => ['post.show']], function () {
                // 投稿詳細画面表示
                Route::get('/post/{post}', 'PostController@show')->name('post.show');
                // });
                // 掲示板コメント投稿処理
                Route::post('/post_comment/{post_comment}', 'PostCommentsController@store')->name('post_comment.store');
                // 掲示板コメント投稿処理、編集画面表示、編集処理、削除処理
                Route::resource('post_comment', 'PostCommentsController', ['only' => ['edit', 'update', 'destroy']]);
                // 掲示板投稿のいいね処理
                Route::post('/post_favorite', 'PostFavoritesController@postFavorite')->name('post_favorite');
                // 掲示板投稿のコメントのいいね処理
                Route::post('/post_comment_favorite', 'PostCommentFavoritesController@postCommentFavorite')->name('post_comment_favorite');
            });
        });
    });
});
