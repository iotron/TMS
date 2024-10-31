<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(\Spatie\Permission\Models\Role::class, \App\Policies\RolePolicy::class);


        Gate::before(function ($user, $ability) {
            if ($user instanceof User) {
//                return true;
                return $user->hasRole('super_admin');
            }
            // return $user->hasRole([Role::SuperAdmin, Role::Admin]) ? true : null;
        });
    }
}
