<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    // 投稿者と管理者の絞り込み
    public static function contributorAndAdmin($id)
    {
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }
}
