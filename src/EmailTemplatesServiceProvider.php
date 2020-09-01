<?php

namespace Codoffer\EmailTemplates;

use Illuminate\Support\ServiceProvider;

class EMailTemplatesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations')
            ], 'migrations');
        }
    }

    public function register()
    {
    }
}
