<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostSubCategory;

class PostSubCategoriesController extends Controller
{
    //
//サブカテゴリー登録
    public function store(Request $request) {

        $subCateGory = new PostSubCategory();
        $data['post_main_category_id'] = $request->post_main_category_id;
        $data['sub_category'] = $request->sub_category;

        $subCateGory->fill($data)->save();

        return redirect()->route('userPostIndex');
    }
//サブカテゴリー削除
    public function destroy($id) {
        PostSubCategory::postSubCategoryDestroy($id);
        return back();
    }
}
