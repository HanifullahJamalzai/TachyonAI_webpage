<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //define admin user role
        Gate::define('isAdmin', function($user){
            return $user->user_type == 'admin';
        });

        // define author user role
        Gate::define('isAuthor', function($user){
            return $user->user_type == 'author';
        });

        // define guest user role
        Gate::define('isGuest', function($user){
            return $user->user_type == 'guest';
        });
    }
}
