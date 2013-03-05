<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| The view used as a layout for the admin panel
	|--------------------------------------------------------------------------
	*/
	'layout' => 'firadmin::layout',

	/*
	|--------------------------------------------------------------------------
	| Navigation array us to generate the nav in admin panel
	| 
	| 'navigation' => array(
	|	'uri' => 'title' //The key is use to generate the Url
	| )
	|--------------------------------------------------------------------------
	*/
	'navigation' => array(
		'admin' => 'Dashboard',
		'admin/user' => 'Users'
	),

	/*
	|--------------------------------------------------------------------------
	| You can inverse the color of the twitter bootstrap nav bar.
	| You jsut need to set to TRUE
	|--------------------------------------------------------------------------
	*/
	'navigation_inverse' => false,
	
	/*
	|--------------------------------------------------------------------------
	| The name of the project that would be displayed as "brand" in the layout
	|--------------------------------------------------------------------------
	*/
	'project_name' => 'Firadmin',

	/*
	|--------------------------------------------------------------------------
	| The project base URL
	|--------------------------------------------------------------------------
	*/
	'project_url' => '#',
	
	/*
	|--------------------------------------------------------------------------
	| Title of the application display in the browser
	|--------------------------------------------------------------------------
	*/
	'title' => 'Firadmin - Admin panel for Laravel 4+',
	
	/*
	|--------------------------------------------------------------------------
	| Enabled the default routing provided by the package
	|--------------------------------------------------------------------------
	*/
	'default_routing' => true,
	
	/*
	|--------------------------------------------------------------------------
	| If you want to use custom routing but you want to use the default package controller,
	| You must change the URI of the route in this configurations to redirect controller properly
	|--------------------------------------------------------------------------
	*/
	'route' => array(
		'login' => 'admin/login',
		'user' => 'admin/user',
		'logout' => 'admin/logout'
	),
	
	/*
	|--------------------------------------------------------------------------
	| The default number of items you wish to display per page. Currently use by the paginator
	|--------------------------------------------------------------------------
	*/
	'paginate' => 10,
	
	/*
	|--------------------------------------------------------------------------
	| Assets you want to integrate in the layout
	|--------------------------------------------------------------------------
	*/
	'assets' => array(
		'css' => array(
			'//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css'
		),
		'js' => array(
			'//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js'
		)
	),
	
	/*
	|--------------------------------------------------------------------------
	| ACL available resources list
	|--------------------------------------------------------------------------
	*/
	'resources' => array(
		'user'
	),
	
	/*
	|--------------------------------------------------------------------------
	| ACL available roles list
	|
	| If you don't want to handle permissions in your application, use only the administrator roles.
	| Also, you can add custom roles for your application and custom resources.
	|
	|--------------------------------------------------------------------------
	*/
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
);