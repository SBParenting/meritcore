<?php namespace App\Libraries\State;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class StateFacade extends IlluminateFacade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'state'; }

}