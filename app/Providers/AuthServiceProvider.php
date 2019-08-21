<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-deposit', function ($user) {
            return $user->hasRole('ACCOUNTANT');
        });

        Gate::define('add-expense', function ($user) {
            return $user->hasRole('MANAGER');
        });

        Gate::define('approve-expense', function ($user) {
            return $user->hasRole('AUTHORITY');
        });

        Gate::define('disburse', function ($user) {
            return $user->hasRole('ACCOUNTANT');
        });
    }
}
