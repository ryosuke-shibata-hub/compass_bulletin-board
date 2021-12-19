<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];

    public function postSubCategory() {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }

    public static function postMainCategoryQuery() {
        return self::with('postSubCategory');
    }

    public static function  postMainCategoryList() {
        return self::postMainCategoryQuery()->get();
    }

    public static function postMainCategoryDestroy($id) {
s
        $post_main_category = PostMainCategory::findOrFail($id);
        if ($post_main_category->postSubCatagoryIsExistence($post_main_category)) {
            $post_main_category->delete();
        }
        return \App::abort(403,'unauthorized action.');
    }

    public static function postSubCatagoryIsExistence($main_data) {

        return $main_data->postSubCategory->isEmpty();
    }

}
