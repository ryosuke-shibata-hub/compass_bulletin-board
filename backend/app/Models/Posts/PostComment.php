<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];
//コメント機能
    public static function comment_store($request,$id) {

        $comment = new PostComment();
        $data['comment'] = $request->post_comment;
        $data['post_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();

        $comment->fill($data)->save();

    }
//Userとのリレーション
    public function user() {
        return $this->belongsTo('App\Models\Users\User','user_id');
    }
}
