<?php namespace Firalabs\Firadmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Firalabs\Firadmin\AjaxSupport;
use Firalabs\Firadmin\Permissions;

/**
 * Package service provider
 * 
 * @author maxime.beaudoin
 */
class FiradminServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('firalabs/firadmin');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//Load package config
		$this->app['config']->package('firalabs/firadmin', __DIR__.'/../../config');
		
		//Create the permissions object in the application instance
		$this->app['permissions'] = new Permissions(
			Config::get('firadmin::roles'),
			Config::get('firadmin::resources')
		);
		
		//Create the Ajax support object
		$this->app['ajaxsupport'] = new AjaxSupport();
        
		//If we want to use the default routing provided by the package
		if(Config::get('firadmin::default_routing') === true){
			
			//Include routes
			include __DIR__.'/routes.php';
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('firadmin');
	}

}