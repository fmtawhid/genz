<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting; // Import the Setting model
use View;
use Illuminate\Support\Facades\Schema;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share the settings with all views only if table exists and has required columns
        if (Schema::hasTable('settings') && Schema::hasColumn('settings', 'deleted_at')) {
            View::share('settings', Setting::first());
        } else {
            View::share('settings', null);
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
