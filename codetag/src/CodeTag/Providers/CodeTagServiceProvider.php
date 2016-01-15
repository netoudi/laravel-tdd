<?php

namespace CodePress\CodeTag\Providers;


use Illuminate\Support\ServiceProvider;

class CodeTagServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('databases/migrations')], 'migrations');
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