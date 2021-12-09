<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];

    // PostSubCategoryとのリレーション
    public function postSubCategories()
    {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }

    // クエリ作成
    public static function postMainCategoryQuery()
    {
        return self::with('postSubCategories');
    }

    // メインカテゴリー一覧
    public static function postMainCategoryLists()
    {
        return self::postMainCategoryQuery()->get();
    }

    // サブカテゴリーがあるかどうかの判断（nullだったらtrueを返す）
    public static function postSubCategoryIsExistence($post_main_category)
    {
        return $post_main_category->postSubCategories->isEmpty();
    }

    // メインカテゴリーの削除処理
    public static function postMainCategoryDestroy($id)
    {
        $post_main_category = PostMainCategory::findOrFail($id);

        if ($post_main_category->postSubCategoryIsExistence($post_main_category)) {
            $post_main_category->delete();
        }
        return \App::abort(403, 'Unauthorized action.');
    }
}
