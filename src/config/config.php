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
	| Project name
	|--------------------------------------------------------------------------
	*/
	'project_name' => 'Firadmin',
	
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
	| The number of items you wish to display per page. Use by the pagination
	|--------------------------------------------------------------------------
	*/
	'paginate' => 10,
	
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