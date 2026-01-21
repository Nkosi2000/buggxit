<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

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
        // Force HTTPS in production (for both Render and Cloudflare)
        if (App::environment('production')) {
            URL::forceScheme('https');
            
            // Trust Cloudflare proxy headers
            if (isset($_SERVER['HTTP_CF_VISITOR'])) {
                $this->app['request']->server->set('HTTPS', true);
            }
            
            // Set secure cookies
            config(['session.secure' => true]);
            config(['session.same_site' => 'lax']);
        }
    }
}