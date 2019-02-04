<?php

namespace HnhDigital\LaravelTwilio;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Sms', function () {
            return new Sms();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/twilio.php', 'hnhdigital.twilio');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Sms'];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/twilio.php' => config_path('hnhdigital/twilio.php')
        ], 'twilio-config');
    }
}
