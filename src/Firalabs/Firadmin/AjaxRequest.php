<?php
namespace Firalabs\Firadmin;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

/**
 * Ajax rfe library is use to support ajax request on controllers actions
 * 
 * @author maxime.beaudoin
 */
class AjaxRequest
{		
	/**
	 * Constructor
	 * 
	 * @param Request $request
	 */
	public function __construct(Request $request = null)
	{
		//if we have a custom request object
		if($request){
			$this->_request = $request;
			
		//Else take the request object from the application
		} else {
			$this->_request = app()->make('request');
		}
	}
	
	/**
	 * Return true is a Ajax Request, we do not use directly Request::ajax() because we want to be able to 
	 * show data as a json with a optional input parameter for testing purpose.
	 * 
	 * @return bool
	 */
	public function isAjax()
	{
		
		//If we have the custom param or if the ajax header is set
		if($this->_request->input('request') == 'ajax' OR $this->_request->ajax()){
			return true;
		}
		
		return false;
	}
}