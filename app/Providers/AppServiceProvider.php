<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        require_once app_path('Helpers/NotificationHelper.php');
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Web routes yang menggunakan middleware web group
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    public function registerEventListeners()
    {
        /**
         * Auth Event Listeners.
         */
        // Event::listen(
        //     'App\Events\Auth\UserLoginSuccess',
        //     'App\Listeners\Auth\UpdateLoginData',
        //     'App\Listeners\Auth\SendPodcastNotification'
        // );

        /**
         * Frontend Event Listeners.
         */
        // Event::listen('App\Events\Frontend\UserRegistered',
        //     'App\Listeners\Frontend\UserRegistered\EmailNotificationOnUserRegistered'
        // );

        /**
         * Backend Event Listeners.
         */
        // Event::listen(
        //     'App\Events\Backend\UserCreated',
        //     'App\Listeners\Backend\UserCreated\UserCreatedProfileCreate',
        //     'App\Listeners\Backend\UserCreated\UserCreatedNotifySuperUser'
        // );

        // Event::listen(
        //     'App\Events\Backend\UserUpdated',
        //     'App\Listeners\Backend\UserUpdated\UserUpdatedNotifyUser'
        // );
    }
}
