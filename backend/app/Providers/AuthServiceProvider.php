<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // 管理者
        Gate::define('admin', function ($user) {
            return ($user->admin_role === 1);
        });

        // ユーザーと管理者
        Gate::define('user', function ($user) {
            return in_array($user->admin_role, [1, 10], true);
        });
    }
}
