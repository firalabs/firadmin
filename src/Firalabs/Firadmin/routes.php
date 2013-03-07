<?php 
/*
|--------------------------------------------------------------------------
| Register login controllers
|--------------------------------------------------------------------------
*/
Route::group(array ('prefix' => 'admin' ), function ()
{
	Route::controller('login', 'Firalabs\Firadmin\Controllers\LoginController');
	Route::get('logout', 'Firalabs\Firadmin\Controllers\LoginController@getLogout');
	Route::get('login', array('as' => 'login', 'uses' => 'Firalabs\Firadmin\Controllers\LoginController@getLogin'));
});

/*
|--------------------------------------------------------------------------
| Register admin controllers
|--------------------------------------------------------------------------
*/
Route::group(array ('before' => 'auth', 'prefix' => 'admin' ), function ()
{	
	Route::resource('user', 'Firalabs\Firadmin\Controllers\UserController');
	#Route::get('user/{id}/destroy', 'Firalabs\Firadmin\Controllers\UserController@destroy');
	Route::put('user/{id}/change-password', 'Firalabs\Firadmin\Controllers\UserController@changePassword');
});
