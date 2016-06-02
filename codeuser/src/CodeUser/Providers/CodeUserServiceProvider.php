<?php

namespace CodePress\CodeUser\Providers;


use CodePress\CodeUser\Repository\UserRepositoryEloquent;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use CodePress\CodeUser\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CodeUserServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../config/auth.php' => base_path('config/auth.php')], 'config');
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('database/migrations')], 'migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/auth/', 'auth');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codeuser/', 'codeuser');
        require __DIR__ . '/../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        $this->app->singleton('codepress_user_route', function () {
            return new Router();
        });
        $this->app->register(EventServiceProvider::class);
    }

}