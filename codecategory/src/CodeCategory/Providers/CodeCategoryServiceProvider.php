<?php

namespace CodePress\CodeCategory\Providers;


use Illuminate\Support\ServiceProvider;

class CodeCategoryServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('databases/migrations')], 'migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codecategory/', 'codecategory');
        require __DIR__ . '/../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

}