<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\post;
use Auth;
use carbon;

class PostsController extends Controller
{
    //
//投稿ページ
    public function create() {

        return view('User.create',[
            'post_main_categories' => PostMainCategory::postMainCategoryList(),
        ]);
    }
//投稿機能
    public function store(Request $request) {

       post::create_post($request);
       return redirect()->route('userPostIndex');

    }
//投稿一覧
     public function index() {
        return view('User.userPost')
        ->with('posts_lists',Post::posts_lists());
    }

    public function show() {
        return view('User.show');
    }
}
