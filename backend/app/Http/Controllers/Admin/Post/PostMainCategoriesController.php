<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;

class PostMainCategoriesController extends Controller
{
    //

    public function store(Request $request) {

        $mainCategory = new PostMainCategory();

        $data['main_category'] = $request->main_category;

        $mainCategory->fill($data)->save();

        return redirect()->route('userPostIndex');
    }
}
