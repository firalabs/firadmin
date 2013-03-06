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


## Documentation

* [Configurations](#configurations)
* [Binding models](#binding-models)
* [Migrations](#migrations)
* [Create default user](#create-default-user)
* [Register dashboard controller](#register-dashboard-controller)
* [Facades](#facades)
* [Permissions](#permissions)
* [Admin controller development](#admin-controller-development)
* [Custom models repositories](#custom-models-repositories)

##Configurations

Add the package to your service provider in ```app/config/app.php```

```php
Firalabs\Firadmin\FiradminServiceProvider
```

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

If you want to use the default models provided by the package, you must run this migration commands.

```bash
php artisan auth:reminders
php artisan migrate
php artisan migrate --package="firalabs/firadmin"
```

##Create default user

You need to have at least one register user in your database to be able to connect on the admin panel. You can use this database seeder

```php
//Create model object
$user = new Firalabs\Firadmin\Repository\Eloquent\UserRepository();

//Set attributes
$user->username = 'email@example.com';
$user->email = 'email@example.com';
$user->password = 'password';

//Save the user
$user->forceSave();

//Create role
$roles = new Firalabs\Firadmin\Repository\Eloquent\UserRoleRepository();		
$roles->role = 'administrator';		
			
//Save the user role
$user->roles()->save($roles);
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

##Facades

We have two available facades:
* Permission
* AjaxSupport

You can add this facade to your ```app/config/app.php``` file.

```php
array(
	'aliases' => array(
		'AjaxSupport' => 'Firalabs\Firadmin\Facades\AjaxSupport',
		'Permissions' => 'Firalabs\Firadmin\Facades\Permissions'
	)
);
```

##Permissions

To handle privileges, simply use this code in your controller action method. If the role is not allowed, the permissions library will redirect the user to the admin index with a error message.

```php
//Check permission
if(Permissions::isAllowed($role, 'update') !== true){
	return Permissions::getResponse();
}
```

##Admin controller development

When you want to create a new admin controller, simply extend the BaseController provide in the package. Is a example of a dashboard controller create in the folder `app/controllers/Admin/DashboardController.php` 

```php
<?php

/**
 * Default dashboard controller
 * 
 * @author maxime.beaudoin
 */
class Admin_DashboardController extends BaseController {
    
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
```

##Custom models repositories

You can directly extend those in the packages or simply implement the interfaces provided in ```Firalabs\Firadmin\Repository```.

##Enjoy !!

You admin panel is now completly configure. Just go to [http://localhost/admin](http://localhost/admin) to access the admin panel.