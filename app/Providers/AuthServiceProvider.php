<?php

namespace App\Providers;

use App\Events\SetPermission;
use App\Listeners\SetRolePermission;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $listen = [
        SetPermission::class => [
            SetRolePermission::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { 
        
    }
}
