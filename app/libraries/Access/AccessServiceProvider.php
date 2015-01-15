<?php namespace Libraries\Access;

use Illuminate\Support\ServiceProvider as  IlluminateServiceProvider;
use Libraries\Access\Access;

class AccessServiceProvider extends IlluminateServiceProvider {

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
        $this->app->bindShared('access', function($app)
        {
            return new Access($app['config'], $app['auth']);

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('access');
    }

}