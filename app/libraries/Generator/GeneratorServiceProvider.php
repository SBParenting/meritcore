<?php namespace Libraries\Generator;

use Illuminate\Support\ServiceProvider as  IlluminateServiceProvider;
use Libraries\Generator\Generator;

class GeneratorServiceProvider extends IlluminateServiceProvider {

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
        $this->app->bindShared('generator', function($app)
        {
            return new Generator($app['config']);

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('generator');
    }

}