<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
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
        View::composer('partials.nav', function ($view) {
            $notifications = Auth::check() ? Auth::user()->unreadNotifications : collect();
            //   dd($notifications);
            $view->with('notifications', $notifications);
        });
    }
}
