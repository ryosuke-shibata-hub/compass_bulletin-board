<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use App\Models\Posts\post;

class PostCommentsController extends Controller
{
    //
    public function store(Request $request,$id) {
//コメント機能
        PostComment::comment_store($request,$id);
        return back();
    }
}
