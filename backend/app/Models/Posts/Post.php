<?php

namespace App\Models\Posts;
use Auth;
use Carbon\Carbon;

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
//N+1
    public static function postQuery(){
        return self::with([
            'user',
            'postSubCategory',
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
}
