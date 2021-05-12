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

        // access to register form
        Gate::define('register', function ($user) {
            return in_array($user->role_id,[1,2]);
        });

        // limit roles to display
        Gate::define('display-role', function ($user, $role_to_check) {
            switch ($user->role_id) {
                case 1:
                    if(in_array($role_to_check, [1,2,3,4,5]))
                        return true;
                    break;
                case 2:
                    if(in_array($role_to_check, [3,4,5]))
                        return true;
                    break;
            }
            return false;
        });

        // can access a page
        Gate::define('access', function ($user, ...$access_type) {
            return in_array($user->role_id,$access_type);
        });
    }
}
