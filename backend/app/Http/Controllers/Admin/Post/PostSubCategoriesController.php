<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Posts\PostSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostSubCategoriesController extends Controller
{
    public function store(Request $request)
    {
        $post_sub_category = new postSubCategory;
        $data['post_main_category_id'] = $request->post_main_category_id;
        $data['sub_category'] = $request->sub_category;
        $post_sub_category->fill($data)->save();
        return back();
    }

    public function destroy($id)
    {
        PostSubCategory::postSubCategoryDestroy($id);
        return back();
    }
}
