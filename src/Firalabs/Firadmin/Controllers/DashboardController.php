<?php namespace Firalabs\Firadmin\Controllers;

use Illuminate\Support\Facades\View;

/**
 * Default dashboard controller
 * 
 * @author maxime.beaudoin
 */
class DashboardController extends BaseController {
    
	/**
	 * The current active menu URI
	 * 
	 * @var string
	 */
	public $active_menu = 'admin';

	/**
	 * Get the dashboard
	 */
	public function getIndex()
	{
		//Set layout content
		$this->layout->content = View::make('firadmin::dashboard');
	}
}