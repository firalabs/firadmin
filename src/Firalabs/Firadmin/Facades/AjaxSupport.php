<?php namespace Firalabs\Firadmin\Facades;

use Illuminate\Support\Facades\Facade;

class AjaxSupport extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor(){ return 'ajaxsupport'; }

}