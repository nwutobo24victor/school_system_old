<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        //
            Route::middleware('web')->group(function () {
                require base_path('routes/web.php');
                require base_path('routes/auth.php');
                require base_path('routes/admin.php');
            });
    }
}
