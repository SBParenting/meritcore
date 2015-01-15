<?php namespace Libraries\Access;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class AccessFacade extends IlluminateFacade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'access'; }

}