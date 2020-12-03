<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\TaiwanMessage' => 'App\Policies\TaiwanMessagePolicy',
        'App\KoreaMessage' => 'App\Policies\KoreaMessagePolicy',
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
            return $user->isAdmin === User::ROLE_ADMIN;
        });

        // 一般使用者 Gate 規則
        Gate::define('member', function ($user) {
            return $user->isAdmin === User::ROLE_USER;
        });
    }
}
