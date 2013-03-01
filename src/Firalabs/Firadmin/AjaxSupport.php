<?php
namespace Firalabs\Firadmin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AjaxSupport
{
	/**
	 * If the client want a success response in json
	 * 
	 * @param mixed $message
	 * @return bool|Response
	 */
	public function success($message)
	{
		return Response::json(array ('success' => $message ));
	}

	/**
	 * If the client want a error response in json
	 * 
	 * @param mixed $reason
	 * @return bool|Response
	 */
	public function error($reason)
	{
		return Response::json(array ('error' => 1, 'reason' => $reason ));
	}
}