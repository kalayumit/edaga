<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\RoleContract', 'App\Services\RoleService');
        $this->app->bind('App\Contracts\UserContract', 'App\Services\UserService');
        $this->app->bind('App\Contracts\CustomerContract', 'App\Services\CustomerService');
        $this->app->bind('App\Contracts\UserRoleContract', 'App\Services\UserRoleService');
        
        $this->app->bind('App\Contracts\LookupContract', 'App\Services\LookupService');
        $this->app->bind('App\Contracts\LookupTypeContract', 'App\Services\LookupTypeService');
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
