<?php namespace Firalabs\Firadmin\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;

/**
 * Controller use to authentication, retreave password request and logout users
 * 
 * @author maxime.beaudoin
 */
class LoginController extends BaseController {
	
	/**
	 * Constructor
	 */
	public function __construct()
    {    	
    	//Add csrf protection when posting forms
    	$this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Get the login form
	 */
	public function getIndex()
	{
		$this->layout->content = View::make('firadmin::login.login');
	}
	
	/**
	 * Post the login form
	 * 
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Define user creadentials
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);
		
		//Want to be remember ?
		if(Input::get('remember-me')){
			$remember = true;
		} else {
			$remember = false;
		}
		
		//If the login attempt fail
		if ( !Auth::attempt($credentials, $remember) ){
			
			//Redirect to login page
			return Redirect::route('get admin/login')
				->with('reason', Lang::get('firadmin::admin.messages.attempt-fail'))
				->with('error', 1);
			
		//Else attempt succed
		} else {
			
			//Redirect to dashboard
			return Redirect::to('admin');
		}	
	}
	
	/**
	 * Logout the user
	 * 
	 * @return Redirect
	 */
	public function getLogout()
	{		
		//Logout the user
		Auth::logout();
		
		//Redirect to login page
		return Redirect::route('get admin/login')
			->with('success', Lang::get('firadmin::admin.messages.logout-success'));
	}
	
	/**
	 * Get the forgot password form
	 */
	public function getForgotPassword()
	{
		$this->layout->content = View::make('firadmin::login.forgot-password');
	}
	
	/**
	 * Post the forgot password form
	 */
	public function postForgotPassword()
	{
    	return Password::remind(array('email' => Input::get('email')));
	}
	
	/**
	 * Reset the password
	 */
	public function getResetPassword($token)
	{
		$this->layout->content = View::make('firadmin::login.password-reset')->with('token', $token);
	}
	
	/**
	 * Reset the password
	 */
	public function postResetPassword($token)
	{
	    return Password::reset(array('email' => Input::get('email')), function($user, $password)
	    {
	        $user->password = $password;
	
	        $user->forceSave();
	
	        return Redirect::route('get admin/login');
	    });
	}
}