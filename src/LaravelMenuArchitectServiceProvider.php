<?php

namespace Rc1021\LaravelMenuArchitect;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\MenuServiceProvider;

class LaravelMenuArchitectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(MenuArct::class, 'menu_arct');

        $this->loadHelpers();

        $this->mergeConfigFrom(
            __DIR__.'/../config/menu_architect.php', 'menu_architect'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../translations', 'menu_architect');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'menu_architect');

        $this->publishes([
            __DIR__.'/../config/menu_architect.php' => config_path('menu_architect.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../translations' => resource_path('lang/vendor/menu_architect'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/menu_architect'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/menu_architect'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ], 'migrations');
    
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
