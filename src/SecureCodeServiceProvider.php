<?php

namespace AcmeSecureCode;

use AcmeSecureCode\Contracts\SecureCodeInterface;
use Illuminate\Support\ServiceProvider;

class SecureCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SecureCodeInterface::class, SecureCodeService::class);

        $this->mergeConfigFrom(__DIR__.'/config/code-config.php', 'code-config');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/code-config.php' => config_path('code-config.php'),
        ], 'config');
    }
}
