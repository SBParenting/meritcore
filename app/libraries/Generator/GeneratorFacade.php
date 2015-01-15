<?php namespace Libraries\Generator;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class GeneratorFacade extends IlluminateFacade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'generator'; }

}