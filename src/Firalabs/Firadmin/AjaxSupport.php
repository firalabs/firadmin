<?php
namespace Firalabs\Firadmin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;

/**
 * Ajax Support library is use to support ajax request on controllers actions
 * 
 * @author maxime.beaudoin
 */
class AjaxSupport
{
	/**
	 * The response object
	 * 
	 * @var Response
	 */
	protected $_response;
	
	/**
	 * Success response if it's a ajax request
	 * 
	 * @param mixed $message
	 * @return bool
	 */
	public function success($message)
	{
		//Reset response
		$this->_response = null;
		
		//Check if the request type is ajax
		if($this->isAjaxRequest()){
			
			//Set the response
			$this->_response = Response::json(array ('success' => $message ));
			
			//It's a ajax request !!!
			return true;
		}
		
		return false;
	}

	/**
	 * Error response if it's a ajax request
	 * 
	 * @param mixed $reason
	 * @return bool
	 */
	public function error($reason)
	{
		//Reset response
		$this->_response = null;
		
		//Check if the request type is ajax
		if($this->isAjaxRequest()){
			
			//Set the response
			$this->_response = Response::json(array ('error' => 1, 'reason' => $reason ));
			
			//It's a ajax request !!!
			return true;
		}
		
		return false;
	}
	
	/**
	 * Return true is a Ajax Request, we do not use directly Request::ajax() because we want to be able to 
	 * show data as a json with a optional input parameter for testing purpose.
	 */
	public function isAjaxRequest()
	{
		//If we have the custom param or if the ajax header is set
		if(Input::get('request') == 'ajax' OR Request::ajax()){
			return true;
		}
		
		return false;
	}
	
	/**
	 * Get the response
	 * 
	 * @return Reponse
	 */
	public function getResponse(){
		return $this->_response;
	}
}