<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            $cart = Session::get('cart', []);
            $cartCount = array_sum($cart);
            $view->with('cartCount', $cartCount);
        });
    }
}