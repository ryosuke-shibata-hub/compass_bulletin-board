<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Posts\PostMainCategory;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function postCategoryIndex()
    {
        return view('post_category.admin.index', [
            'post_main_categories' => PostMainCategory::postMainCategoryLists(),
        ]);
    }
}
