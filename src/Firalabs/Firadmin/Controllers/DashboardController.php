<?php namespace Firalabs\Firadmin\Controllers;

use Illuminate\Support\Facades\View;

/**
 * Default dashboard controller
 * 
 * @author maxime.beaudoin
 */
class DashboardController extends BaseController {
    
    /**
     * (non-PHPdoc)
     * @see Firalabs\Firadmin\Controllers.BaseController::setupLayout()
     */
    protected function setupLayout()
    {
    	//Trigger parent
    	parent::setupLayout();
		
		//Active menu
		$this->layout->active_menu = 'admin';
    }

	/**
	 * Get the dashboard
	 */
	public function getIndex()
	{
		//Set layout content
		$this->layout->content = View::make('firadmin::dashboard');
	}
}