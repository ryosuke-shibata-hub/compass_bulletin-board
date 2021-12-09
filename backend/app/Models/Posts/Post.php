<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'title',
        'post',
        'event_at',
    ];

    public static function postStore($request)
    {
        $post = new Post;
        $data = $request->only('post_sub_category_id', 'title', 'post');
        $data['user_id'] = Auth::id();
        $data['event_at'] = new Carbon;
        $post->fill($data)->save();
    }

    // Userとのリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }

    // Userとのリレーション(多対多)
    public function userPostFavoriteRelations()
    {
        return $this->belongsToMany('App\Models\Users\User', 'post_favorites', 'post_id', 'user_id');
    }

    // PostSubCategoryとのリレーション
    public function postSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id');
    }

    // PostCommentとのリレーション
    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    // ActionLogとのリレーション
    public function actionLogs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    // クエリ作成
    public static function postQuery()
    {
        return self::with([
            'user',
            'userPostFavoriteRelations',
            'postSubCategory',
            'postComments.user',
            'actionLogs',
        ]);
    }

    // 投稿詳細
    public static function postDetail($id)
    {
        return self::postQuery()->findOrFail($id);
    }

    // 投稿に対してのコメントがあるかどうかの判断（nullだったらtrueを返す）
    public static function postCommentIsExistence($post_detail)
    {
        return $post_detail->postComments->isEmpty();
    }

    // 投稿に対してログインしているユーザーがいいねしているかどうかの判断（nullだったらtrueを返す）
    public static function postFavoriteIsExistence($post_detail)
    {
        return is_null($post_detail->userPostFavoriteRelations->find(Auth::id()));
    }

    // 投稿一覧
    public static function postLists($request, $category_id)
    {
        $keyword = $request->keyword;
        $post_favorite = $request->post_favorite;
        $post_lists = self::postQuery();

        // カテゴリーを選択したときの処理
        if ($category_id) {
            $post_lists = $post_lists->where('post_sub_category_id', $category_id);
        }
        // 検索したときの処理
        if ($keyword) {
            $post_lists = $post_lists
                ->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('post', 'like', '%' . $keyword . '%')
                ->orWhereIn('post_sub_category_id', function ($query) use ($keyword) {
                    $query->from('post_sub_categories')
                        ->select('id')
                        ->where('sub_category', $keyword);
                });
        }
        // いいねした投稿一覧を押したときの処理
        if ($post_favorite) {
            $post_lists = $post_lists
                ->orWhereIn('id', function ($query) {
                    $query->from('post_favorites')
                        ->select('post_id')
                        ->where('user_id', Auth::id());
                });
        }
        return $post_lists->get();
    }

    // 掲示更新処理
    public static function postUpdate($request, $post_detail)
    {
        $data['post_sub_category_id'] = $request->post_sub_category_id;
        $data['title'] = $request->title;
        $data['post'] = $request->post;
        return $post_detail->fill($data)->save();
    }

    // 掲示板の投稿のいいね登録、削除処理
    public static function postFavoriteCreateOrDestroy($post_id, $post_favorite_id)
    {
        $post_detail = self::findOrFail($post_id);

        if ($post_favorite_id) {
            return $post_detail->userPostFavoriteRelations()->detach(Auth::id());
        } else {
            return $post_detail->userPostFavoriteRelations()->attach(Auth::id());
        }
    }
}
