<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public static function postSubCategoryDestroy($id) {
        $post_sub_category = PostSubCategory::findOrFail($id);
        $post_sub_category->delete();
    }
}
