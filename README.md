#Firadmin
Basic admin panel for Laravel 4.

##Features
* User management
* ACL component for application privileges management
* Complete admin panel UI using Twitter bootstrap 2.3.1
* Complete login component with password reset and reminder

##Installation

Add `firalabs/firadmin` as a requirement to `composer.json`:

```javascript
{
    "require": {
        "firalabs/firadmin": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

##Configurations

Publish the package configuration to your laravel application to override some of the configuration options.

**Executing The Config Publish Command**

```bash
php artisan config:publish firalabs/firadmin
```

The configuration files could now be found in `app/config/packages/firalabs/firadmin` folder. Just read the descriptions for each configurations to know what you can do.

##Binding models

You need to bind a user and a user role model to your application. By default, the package already provide those. Simply add this few lines in `app/start/global.php`

```php
/*
|--------------------------------------------------------------------------
| Application IoC Container binding
|--------------------------------------------------------------------------
|*/
App::bind('UserRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRepository'); //User model
App::bind('UserRoleRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRoleRepository'); //User role model
```

**Note** : Don't forget to set the user model in the `app/config/auth.php` to `'model' => 'Firalabs\Firadmin\Repository\Eloquent\UserRepository'`

##Migrations

IF you want to use the default model provide by the package, you must run the package migrations.

```bash
php artisan migrate --package="firalabs/firadmin"
```

##Register dashboard controller

You must set a route to the dashboard admin panel. We provide a default dashboard controller for testing purpose. Just add this few lines of code.

```php
/*
|--------------------------------------------------------------------------
| Register admin controllers
|--------------------------------------------------------------------------
*/
Route::group(array ('before' => 'auth', 'prefix' => 'admin' ), function ()
{	
	Route::get('/', 'Firalabs\Firadmin\Controllers\DashboardController@getIndex');
});
```

##Create default user

You need to create a default user to access the admin panel

##Admin controller development

When you want to create a new admin controller, simply extend the BaseController provide in the package. Is a example of a dashboard controller create in the folder `app/controllers/Admin/DashboardController.php` 

```php
<?php

use Firalabs\Firadmin\Controllers\BaseController;

/**
 * Dashboard controller for admin panel
 * 
 * @author maxime.beaudoin
 */
class Admin_DashboardController extends BaseController {
    
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
		$this->layout->content = View::make('admins.dashboard');
	}
}
```

##Custom models repositories

You can directly extend those in the packages or simply implement the interfaces provided in the Firalabs\Firadmin\Repository namespace.

##Enjoy !!

You admin panel is now completly configure. Just go to [http://localhost/admin](http://localhost/admin) to access the admin panel.