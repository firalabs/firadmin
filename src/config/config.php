<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| Layout view name
	|--------------------------------------------------------------------------
	*/
	'layout' => 'firadmin::layout',

	/*
	|--------------------------------------------------------------------------
	| Admin navigation array
	|--------------------------------------------------------------------------
	*/
	'navigation' => array(
		'admin' => 'Dashboard',
		'admin/user' => 'Users'
	),

	/*
	|--------------------------------------------------------------------------
	| Set navigation inverse to true if you want to display the nav bar in black
	|--------------------------------------------------------------------------
	*/
	'navigation_inverse' => false,
	
	/*
	|--------------------------------------------------------------------------
	| Project name
	|--------------------------------------------------------------------------
	*/
	'project_name' => 'Firadmin',

	/*
	|--------------------------------------------------------------------------
	| Project url
	|--------------------------------------------------------------------------
	*/
	'project_url' => '#',
	
	/*
	|--------------------------------------------------------------------------
	| Title of the application
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
	| When you use custom route, you MUST change redirect routing in the controller
	| to match your custom route.
	|--------------------------------------------------------------------------
	*/
	'route' => array(
		'login' => 'admin/login',
		'user' => 'admin/user',
		'logout' => 'admin/logout'
	),
	
	/*
	|--------------------------------------------------------------------------
	| The number of items you wish to display per page. Use by the pagination
	|--------------------------------------------------------------------------
	*/
	'paginate' => 10,
	
	/*
	|--------------------------------------------------------------------------
	| The number of items you wish to display per page. Use by the pagination
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
	| Also, you can add custom roles for your application.
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