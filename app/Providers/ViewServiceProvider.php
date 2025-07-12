<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::component('backend.components.head', 'head');
        Blade::component('backend.components.sidebar', 'sidebar');
        Blade::component('backend.components.navbar', 'navbar');
        Blade::component('backend.components.footer', 'footer');
        Blade::component('backend.components.script', 'script');
        Blade::component('backend.components.breadcrumb', 'breadcrumb');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
