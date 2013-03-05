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

##Binding User model IoC

You need to bind a user model to your application. By default, the package already provide one. Simply add this few lines in `app/start/global.php`

```php
/*
|--------------------------------------------------------------------------
| Application IoC Container binding
|--------------------------------------------------------------------------
|*/
App::bind('UserRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRepository');
App::bind('UserRoleRepositoryInterface', 'Firalabs\Firadmin\Repository\Eloquent\UserRoleRepository');
```

##Migrations

IF you want to use the default model provide by the package, you must run the migrations.

```bash
php artisan migrate --package="firalabs/firadmin"
```

##Register Dashboard controller

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

##Custom user model

##Enjoy !!

You admin panel is now completly configure. Just go to http://localhost/admin to access the admin panel.