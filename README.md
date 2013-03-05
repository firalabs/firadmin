#Firadmin
Basic admin panel for Laravel 4.

##Features
* ACL component for application privileges management
* User management
* Twitter bootstrap 2.3.1 for the UI
* Complete login component
** Login/Logout
** Password reset

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

####Executing The Config Publish Command

```bash
php artisan config:publish firalabs/firadmin
```