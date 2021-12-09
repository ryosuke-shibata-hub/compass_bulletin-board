<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Posts\PostMainCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostMainCategoriesController extends Controller
{
    public function store(Request $request)
    {
        $main_category = new PostMainCategory;
        $data['main_category'] = $request->main_category;
        $main_category->fill($data)->save();
        return back();
    }

    public function destroy($id)
    {
        PostMainCategory::postMainCategoryDestroy($id);
        return back();
    }
}
