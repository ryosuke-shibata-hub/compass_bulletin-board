<?php

namespace App\Models\Posts;
use Auth;
use Carbon\Carbon;
use App\Models\Users\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];
//ユーザーテーブルリレーション
    public function user(){
        return $this->belongsTo('App\Models\Users\User','user_id');
    }
//サブカテゴリーテーブルリレーション
    public function postSubCategory() {
        return $this->belongsTo('App\Models\Posts\PostSubCategory','post_sub_category_id');
    }
//post_commentのリレーション
    public function postComments() {
        return $this->hasMany('App\Models\Posts\PostComment');
    }
//N+1
    public static function postQuery(){
        return self::with([
            'user',
            'postSubCategory',
            'postComments.user',
        ]);
    }
//post->user,subcate一覧（リレーション）
    public static function posts_lists() {
        return self::postQuery()->get();
    }
//投稿機能
    public static function create_post($request) {

        $post =  new post;
        $data = $request->only('post_sub_category_id','title','post');
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $post->fill($data)->save();

    }
//投稿詳細
   public static function postDetail($id) {
        return self::postQuery()->findOrFail($id);
    }
//投稿編集
    public static function postUpdate($request,$posts_detail)
    {
        $data['post_sub_category_id'] = $request->post_sub_category_id;
        $data['title'] = $request->title;
        $data['post'] = $request->post;

        return $posts_detail->fill($data)->save();
    }

//コメントがある場合削除停止
    public static function postCommentIsExistence($posts_detail) {
        return $posts_detail->postComments->isEmpty();
    }

}
