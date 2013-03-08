<?php namespace Firalabs\Firadmin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for Ajax request
 * 
 * @author maxime.beaudoin
 */
class AjaxRequest extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor(){ return 'ajaxrequest'; }

}