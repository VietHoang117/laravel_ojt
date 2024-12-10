<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        //        View::composer('*', function ($view) {
//            $user = Auth::user();
//            $isSystemRole = $user && $user->roles()->where('is_system_role', true)->exists();
//            $permissions = $isSystemRole ? collect() : $user->roles->flatMap->permissions->pluck('name')->unique();
//
//            $view->with(compact('permissions', 'isSystemRole'));
//
//        });

        // Blade::component('components.make-application', 'make-application');
    }
}
