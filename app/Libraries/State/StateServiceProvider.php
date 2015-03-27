<?php namespace App\Libraries\State;

use Illuminate\Support\ServiceProvider as  IlluminateServiceProvider;
use App\Libraries\State\State;

class StateServiceProvider extends IlluminateServiceProvider {

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
        $this->app->bindShared('state', function($app)
        {
            return new State($app['config'], $app['session'], $app['view']);

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('state');
    }

}