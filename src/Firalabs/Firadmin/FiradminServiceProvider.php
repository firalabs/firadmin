<?php namespace Firalabs\Firadmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
		
		//If we want to initialize automaticly the permissions manager in the application
		if(Config::get('firadmin::init_permissions') === true){
		
			//Create the permissions object in the application instance
			$this->app['permissions'] = new Permissions(
				Config::get('firadmin::roles'),
				Config::get('firadmin::resources')
			);
			
		}
        
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