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
}
