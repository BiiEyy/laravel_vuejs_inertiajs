<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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
        Inertia::share([
            'errors' => function(){
                return Session::get( key: 'errors')
                ? Session::get( key: 'errors')->getBag('default')->getMessages()
                : (object) [];
            },
        ]);

        Inertia::share('flash', function() {
            return [
                'message' => Session::get( key: 'message'),
            ];
        });
        Inertia::share('csrf_token', function() {
            return csrf_token();
        });
    }
}
