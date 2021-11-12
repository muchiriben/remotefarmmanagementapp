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

        Gate::define('is-admin', function ($user) {
            return $user->hasAnyRole('admin');
        });

        Gate::define('is-urban-farmer', function ($user) {
            return $user->hasAnyRole('urban-farmer');
        });

        Gate::define('is-rural-farmer', function ($user) {
            return $user->hasAnyRole('rural-farmer');
        });

        Gate::define('is-agro-company', function ($user) {
            return $user->hasAnyRole('agro-company');
        });
    }
}
