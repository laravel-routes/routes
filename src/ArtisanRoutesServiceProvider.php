<?php

namespace PhHitachi\Routes;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use PhHitachi\Routes\Commands\ArtisanRoutes;
use PhHitachi\Routes\Commands\ArtisanFacades;

class ArtisanRoutesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->routes();
        $this->command();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro("domains", function($options, Closure $definition) 
        {
            if (is_array($options)) 
            {
                foreach ($options['domain'] as $domain) {
                    Route::group(array_merge($options, ['domain' => $domain]), $definition);
                }
            }
        });
    }

    public function routes()
    {
        $this->app->bind('Routes', function($app){
            return new Router($this->app->make('router'));
        });

        //$this->app->singleton(Services\RouteDispatcher::class);
    }

    public function command()
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                ArtisanRoutes::class,
                ArtisanFacades::class,
            ]);
        }
    }
}
