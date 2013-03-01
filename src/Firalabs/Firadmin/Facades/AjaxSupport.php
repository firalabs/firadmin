<?php namespace Firalabs\Firadmin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for Ajax support
 * 
 * @author maxime.beaudoin
 */
class AjaxSupport extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor(){ return 'ajaxsupport'; }

}