<?php namespace Firalabs\Firadmin\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;
use Illuminate\Support\Facades\Hash;

/**
 * User model
 * 
 * @author maxime.beaudoin
 */
class UserModel extends Ardent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	/**
	 * Defining guarded attributes on the model
	 *
	 * @var array
	 */
	protected $guarded = array('created_at', 'updated_at', 'roles');
	
	/**
	 * Automatically Hydrate Ardent Entities
	 * 
	 * @var bool
	 */
	public $autoHydrateEntityFromInput = true;
	
	/**
	 * Automatically Purge Redundant Form Data
	 * 
	 * @var bool
	 */
	public $autoPurgeRedundantAttributes = true;
	
	/**
	 * The password attribute
	 * 
	 * @var array
	 */
	public static $passwordAttributes = array('password');
	
	/**
	 * Hash the password automaticly
	 * 
	 * @var bool
	 */
	public $autoHashPasswordAttributes = true;
	
	/**
	* Ardent validation rules
	*/
	public static $rules = array(
    	'username' => 'required|min:5|unique:users',
    	'email' => 'required|email|unique:users',
    	'password' => 'required|min:5',
    	'password_confirmation' => 'required|min:5|same:password',
    );

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	/**
	 * Roles relations
	 */
	public function roles()
    {
        return $this->hasMany('Firalabs\Firadmin\Models\UserRolesModel', 'user_id');
    }
    
    /**
     * Get the roles name list
     * 
     * @return array
     */
    public function getRoles(){
    	
    	//Default
    	$roles = array();
    	
    	//Add each role name in the list
    	foreach ($this->roles as $role){
    		$roles[] = $role->role;
    	}
    	
    	//Return the role list
    	return $roles;    	
    }

}