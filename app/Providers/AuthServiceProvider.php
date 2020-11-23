<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 系統管理者 Gate 規則
        Gate::define('admin', function ($user) {
            return $user->role === User::ROLE_ADMIN;
        });

        // 一般管理者 Gate 規則
        Gate::define('manager', function ($user) {
            return $user->role === User::ROLE_MANAGER;
        });

        // 一般使用者 Gate 規則
        Gate::define('user', function ($user) {
            return $user->role === User::ROLE_USER;
        });
    }
}

