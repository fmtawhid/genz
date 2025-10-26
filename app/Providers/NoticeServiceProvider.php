<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NoticeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Bind the Notice model if needed for dependency injection
        $this->app->singleton('NoticeService', function ($app) {
            return new \App\Models\Notice();
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Fetch all notices (or add filters if needed)
        $notices = \App\Models\Notice::all();

        // Share the notices with all views
        \View::share('notices', $notices);
    }

}