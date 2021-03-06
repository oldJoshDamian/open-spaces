<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Space' => 'App\Policies\SpacePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('search', function (?User $user) {
            $isLoginRoute = request()->routeIs('login');
            $isRegisterRoute = request()->routeIs('register');
            $homeRoute = request()->routeIs('home');
            $viewResourceRoute = request()->routeIs('resource.view');
            if (($isLoginRoute) || ($homeRoute) || ($isRegisterRoute) || ($viewResourceRoute)) {
                return false;
            }
            return true;
        });
    }
}
