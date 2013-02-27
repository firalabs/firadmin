<?php namespace Firalabs\Firadmin\Controllers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Base controller used by the package
 * 
 * @author maxime.beaudoin
 */
class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		//Set layout view
		$this->layout = View::make(Config::get('firadmin::layout'));
		
		//Default layout content is null
		$this->layout->content = '';		
		
		//Set navigation
		$this->layout->navigation = Config::get('firadmin::navigation');
		
		//Set application title
		$this->layout->title = Config::get('firadmin::title');
		
		//Set project name
		$this->layout->project_name = Config::get('firadmin::project_name');
	}

}