## !!! DEPRECATED !!!
**This package is no longer actively maintained. The next version of Laravel 5 should propably contain all basic stuff you need to start a admin panel.**

#Firadmin
Laravel 4 package used to create a beautiful admin panel with default user managment. This package is currently under active development, following Laravel 4.

[![Build Status](https://travis-ci.org/firalabs/firadmin.png)](https://travis-ci.org/firalabs/firadmin)
[![Total Downloads](https://poser.pugx.org/firalabs/firadmin/downloads.png)](https://packagist.org/packages/firalabs/firadmin)
[![Latest Stable Version](https://poser.pugx.org/firalabs/firadmin/v/stable.png)](https://packagist.org/packages/firalabs/firadmin)

##Features
* Resourceful User management with roles permissions
* Base controller use for admin panel development
* ACL component for privilege management
* Complete UI admin panel using Twitter Bootstrap 2.3
* Complete login component with password reset and reminder
* Easily configurable

##Installation

For laravel 4.0 use firadmin version 1.0.* and for laravel 4.1 use firadmin version 1.1.* and above.

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `firalabs/firadmin`.

```javascript
{
    "require": {
        "firalabs/firadmin": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

Once this operation completes, you need to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

```php
Firalabs\Firadmin\FiradminServiceProvider
```


## Documentation

* [Screenshots](#screenshots)
* [Configurations](#configurations)
* [Binding models](#binding-models)
* [Migrations](#migrations)
* [Create default user](#create-default-user)
* [Register dashboard controller](#register-dashboard-controller)
* [Facades](#facades)
* [Permissions](#permissions)
* [Ajax request](#ajax-request)
* [Admin controller development](#admin-controller-development)
* [Custom models repositories](#custom-models-repositories)

##Screenshots
[![firadmin login](https://raw.github.com/firalabs/firadmin/master/screenshots/login.png)](#screenshots-login)
[![firadmin user-admin](https://raw.github.com/firalabs/firadmin/master/screenshots/user-admin.png)](#screenshots-user-admin)

##Configurations

To configure the package to meet your needs, you must publish the configuration in your application before you can modify them. Run this artisan command.

```bash
php artisan config:publish firalabs/firadmin
```

The configuration files could now be found in `app/config/packages/firalabs/firadmin`. Read the description for each configurations to know what you can override.

##Binding models

You need to bind a user and a user role model to your application. By default, the package already provide those. Add this few lines in `app/start/global.php`

```php
/*
|--------------------------------------------------------------------------
| Application IoC Container binding
|--------------------------------------------------------------------------
|*/
App::bind('Firalabs\Firadmin\Repository\UserRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRepository'); //User model
App::bind('Firalabs\Firadmin\Repository\UserRoleRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRoleRepository'); //User role model
```

After that, you must set the same user repository has a model in `app/config/auth.php`

```
'model' => 'Firalabs\Firadmin\Repository\Eloquent\UserRepository'
```

##Migrations

If you use the default models provided in the package, you must run this migration commands.

```bash
php artisan auth:reminders
php artisan migrate
php artisan migrate --package="firalabs/firadmin"
```

##Create default user

You need to have at least one register user in your database. We provided a easy way to create a user using artisan command. Use `--role=""administrator""` when setting up a user for the first time.

```bash
php artisan create:user [--role[="..."]] username email password
```

You can also change the role names Firadmin checks on `app/config/packages/firalabs/firadmin/config.php`.

```php
'roles' => array(
	/*
	 * Grant all privileges to the administrator roles.
	 */
	'administrator'  => true,

	/*
	 * Granted basics CRUD privileges to the user administrator role on the user resource.
	 */
	'user_administrator' => array('user' => array('create', 'read', 'update', 'delete'))
)
```


##Register dashboard controller

You must set a route to the dashboard admin panel in `app/routes.php`. We provide a default dashboard controller for testing purpose.

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
* Permissions
* AjaxRequest

You can add this facade to your ```app/config/app.php``` file.

```php
array(
	'aliases' => array(
		'AjaxRequest' => 'Firalabs\Firadmin\Facades\AjaxRequest',
		'Permissions' => 'Firalabs\Firadmin\Facades\Permissions'
	)
);
```

##Permissions

To handle privileges on the current logged user, simply use this code in your controller action method..

```php
//Check permission
if(Permissions::isAllowed(Auth::user(), 'user', 'read') !== true){
	return Redirect::route('login')
		->with('reason', Lang::get('firadmin::admin.messages.insufficient-permission') . '<br>')
		->with('error', 1);
}
```

##Ajax Request
Documentation coming soon ...

##Admin controller development

When you want to create a new admin controller, simply extend the BaseController provide in the package. Is a example of a dashboard controller create in the folder `app/controllers/Admin/DashboardController.php` 

```php
<?php

use Firalabs\Firadmin\Controllers\BaseController;

/**
 * Default dashboard controller
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

You admin panel is now configured. Just go to [http://localhost/admin](http://localhost/admin) to access the admin panel.

Feel free to contact me !!!