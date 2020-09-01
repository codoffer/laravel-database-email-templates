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

            $this->publishes([
                __DIR__ . '/../config/email_template.php' => config_path('email_template.php'),
            ], 'configs');

            $this->publishes([
                __DIR__ . '/../views/emails/' => resource_path('views/emails')
            ], 'resources');
        }
    }

    public function register()
    {
    }
}
