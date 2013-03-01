<?php namespace Firalabs\Firadmin\Controllers;

use Firalabs\Firadmin\Models\UserRolesModel;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

/**
 * Controller used for users managment
 * 
 * @author maxime.beaudoin
 */
class UserController extends BaseController {
	
	/**
	 * Constructor
	 */
	public function __construct()
    {    	    	
    	//Add csrf protection when posting forms
    	$this->beforeFilter('csrf', array('on' => array('post', 'put')));
    	
    	//Get the user model used by authentification
    	$model_name = Config::get('auth.model');
    	
    	//Create user object
    	$this->user = new $model_name;
    }
    
    /**
     * (non-PHPdoc)
     * @see Firalabs\Firadmin\Controllers.BaseController::setupLayout()
     */
    protected function setupLayout()
    {
    	//Trigger parent
    	parent::setupLayout();
		
		//Active menu
		$this->layout->active_menu = 'admin/user';
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		//Check permission
		if(app()->permissions->isAllowed('user', 'update') !== true){
			return app()->permissions->isAllowed('user', 'updated');
		}
		
		//Define the number of item we want to display per page
		$paginate = Input::get('take')?(int) Input::get('take'):Config::get('firadmin::paginate');
		
		//Check if we want to display the result in json
		if(Input::get('output') == 'json'){
			
			//Define the number of skipped row
			$skip = Input::get('page')?(Input::get('page')-1)*$paginate:0;
			
			//Return users list response has a json
			return Response::json($this->user->with('roles')->skip($skip)->take($paginate)->get()->toArray());
		}
		
		//Define the layout content
		$this->layout->content = View::make('firadmin::users.index', array(
			'users' => $this->user->with('roles')->paginate($paginate)->appends('take', $paginate)
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		
		//Check permission
		if(app()->permissions->isAllowed('user', 'create') !== true){
			return app()->permissions->isAllowed('user', 'updated');
		}
		
		//Check if we have selected roles
		if(Input::old('roles')){
			
			$selected_roles = Input::old('roles');
                        
		 //Else set to default
		} else {
			$selected_roles = array();
		}
		
		//Define the layout content
		$this->layout->content = View::make('firadmin::users.create', array('selected_roles' => $selected_roles));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{			
		//Check permission
		if(app()->permissions->isAllowed('user', 'create') !== true){
			return app()->permissions->isAllowed('user', 'create');
		}
				
		//Save
		if($this->user->save()){
			
			//If we have roles
			if(Input::get('roles')){
				
				//foreach role
				foreach (Input::get('roles') as $role) {
				
					//Create role
					$role = new UserRolesModel(array('role' => $role));				
			
					//Insert role
					$this->user->roles()->save($role);
				}
			}
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'success' => Lang::get('firadmin::admin.store-success')
				));
			}
	
			//Redirect
			return Redirect::to('admin/user')->with('success', Lang::get('firadmin::admin.store-success'));
			
		} else {	

			//Flash input
			Input::flash();
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => $this->user->errors()->all(':message')
				));
			}
		
			//Redirect
			return Redirect::to('admin/user/create')->with('reason', $this->user->errors()->all(':message<br>'))->with('error', 1);
			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{			
		//Check permission
		if(app()->permissions->isAllowed('user', 'read') !== true){
			return app()->permissions->isAllowed('user', 'read');
		}
		
		//Get the user in database
		$user = $this->user->find($id);
		
		//If the user not exist
		if(!$user){
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => Lang::get('firadmin::admin.messages.user-not-found')
				));
			}
				
			//Error reason
			return Redirect::to('admin/user')->with('reason', Lang::get('firadmin::admin.messages.user-not-found'))->with('error', 1);
			
		} else {
		
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json($user->toArray());
			}
					
			//Define the layout content
			$this->layout->content = View::make('firadmin::users.show', array(
				'user' => $user
			));
			
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//Check permission
		if(app()->permissions->isAllowed('user', 'update') !== true){
			return app()->permissions->isAllowed('user', 'update');
		}	
		
		//Get the user data
		$user = $this->user->find($id);
		
		//If the user not exist
		if(!$user){
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => Lang::get('firadmin::admin.messages.user-not-found')
				));
			}
				
			//Error reason
			return Redirect::to('admin/user')->with('reason', Lang::get('firadmin::admin.messages.user-not-found'))->with('error', 1);
			
		} else {
		
			//Check if we have selected roles
			if(Input::old('roles')){
				
				$selected_roles = Input::old('roles');
	                        
			 //Else set to default
			} else {
				$selected_roles = $user->getRoles();
			}
			
			$this->layout->content = View::make('firadmin::users.edit', array(
				'user' => $user,
				'selected_roles' => $selected_roles
			));
			
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		//Check permission
		if(app()->permissions->isAllowed('user', 'update') !== true){
			return app()->permissions->isAllowed('user', 'update');
		}
			
		//Get the user in database
		$user = $this->user->find($id);
		
		//If the user not exist
		if(!$user){
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => Lang::get('firadmin::admin.messages.user-not-found')
				));
			}
				
			//Error reason
			return Redirect::to('admin/user')->with('reason', Lang::get('firadmin::admin.messages.user-not-found'))->with('error', 1);
			
		} else {
			
			//Define validation rules
			$rules = array(
			    'username' => 'required|min:5|unique:users',
			    'email' => 'required|email|unique:users',
		    );
			
			//Check if the username have changed
			if($user->username == Input::get ('username')){
				
				//The email adress not changed, so replace the email validation rules
				$rules['username'] = 'required|min:5';
				
			}
			
			//Check if the user email have changed
			if($user->email == Input::get ('email')){
				
				//The email adress not changed, so replace the email validation rules
				$rules['email'] = 'required|email';
				
			}
				
			//Update user
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			
			//Just before save, we don't want to auto hash the existing password, replace this later if possible
			$user->autoHashPasswordAttributes = false;		
				
			//Save
			if($user->save($rules)){			
				
				//Delete the user roles
				$user->roles()->delete();		
				
				//If we have roles
				if(Input::get('roles')){
					
					//foreach role
					foreach (Input::get('roles') as $role) {
					
						//Create role
						$role = new UserRolesModel(array('role' => $role));				
				
						//Insert role
						$user->roles()->save($role);
					}
				}		
			
				//Check if we want to display the result in json
				if(Input::get('output') == 'json'){
					return Response::json(array(
						'success' => Lang::get('firadmin::admin.update-success')
					));
				}
		
				//Redirect
				return Redirect::to('admin/user')->with('success', Lang::get('firadmin::admin.update-success'));
				
			} else {
	
				//Flash input
				Input::flash();		
			
				//Check if we want to display the result in json
				if(Input::get('output') == 'json'){
					return Response::json(array(
						'error' => 1,
						'reason' => $user->errors()->all(':message')
					));
				}
			
				//Redirect
				return Redirect::to('admin/user/' . $id . '/edit')->with('reason', $user->errors()->all(':message<br>'))->with('error', 1);
				
			}
		}
	}

	/**
	 * Change the user password
	 *
	 * @return Response
	 */
	public function changePassword($id)
	{
		//Check permission
		if(app()->permissions->isAllowed('user', 'update') !== true){
			return app()->permissions->isAllowed('user', 'update');
		}
			
		//Get the user in database
		$user = $this->user->find($id);
		
		//If the user not exist
		if(!$user){
			
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => Lang::get('firadmin::admin.messages.user-not-found')
				));
			}
				
			//Error reason
			return Redirect::to('admin/user')->with('reason', Lang::get('firadmin::admin.messages.user-not-found'))->with('error', 1);
			
		} else {
		
			//Define validation rules
			$rules = array(
		    	'password' => 'required|min:5',
		    	'password_confirmation' => 'required|min:5|same:password',
		    );
				
			//Update user	
			$user->password = Input::get('password');
			$user->password_confirmation = Input::get('password_confirmation');
			
			//Save
			if($user->save($rules)){
			
				//Check if we want to display the result in json
				if(Input::get('output') == 'json'){
					return Response::json(array(
						'success' => Lang::get('firadmin::admin.update-password-success')
					));
				}
		
				//Redirect
				return Redirect::to('admin/user')->with('success', Lang::get('firadmin::admin.update-password-success'));
				
			} else {
	
				//Flash input
				Input::flash();
				
				//Check if we want to display the result in json
				if(Input::get('output') == 'json'){
					return Response::json(array(
						'error' => 1,
						'reason' => $user->errors()->all(':message')
					));
				}
				
				//Set reason why error
				return Redirect::to('admin/user/' . $id . '/edit#change-password')->with('reason', $user->errors()->all(':message<br>'))->with('error', 1);
				
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		//Check permission
		if(app()->permissions->isAllowed('user', 'delete') !== true){
			return app()->permissions->isAllowed('user', 'delete');
		}
		
		//Get the user in database
		$user = $this->user->find($id);
		
		//If the user doesn't exist
		if(!$user){
		
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'error' => 1,
					'reason' => Lang::get('firadmin::admin.destroy-fail')
				));
			}
				
			//Error reason
			return Redirect::to('admin/user')->with('reason', Lang::get('firadmin::admin.destroy-fail'))->with('error', 1);
			
		} else {		
			
			//Delete the user roles
			$user->roles()->delete();
			
			//Delete the user
			$user->delete($id);		
		
			//Check if we want to display the result in json
			if(Input::get('output') == 'json'){
				return Response::json(array(
					'success' => Lang::get('firadmin::admin.destroy-success')
				));
			}
			
			//Success message
			return Redirect::to('admin/user')->with('success', Lang::get('firadmin::admin.destroy-success'));
		}
	}

}