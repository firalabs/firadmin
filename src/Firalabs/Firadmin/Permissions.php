<?php namespace Firalabs\Firadmin;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;

/**
 * This is the ACL component use to handle permissions on the laravel application.
 * We use zendframework/zend-permissions-acl packages in the back.
 * 
 * @author maxime.beaudoin
 */
class Permissions 
{
	
	/**
	 * The response object
	 * 
	 * @var Response
	 */
	protected $_response;
	
	/**
	 * The acl object
	 * @var Zend\Permissions\Acl\Acl
	 */
	public $acl;
	
	/**
	 * Constructor
	 * 
	 * @param array $roles
	 * @param array $resources
	 */
	public function __construct($roles, $resources)
	{		
		//Create brand new Acl object
		$this->acl = new Acl();
		
		//Add each resources
		foreach ($resources as $resource){
			
			//Add the resource
			$this->acl->addResource(new Resource($resource));
		}
		
		//Add each roles
		foreach ($roles as $role => $resources){
			
			//Add the role
			$this->acl->addRole(new Role($role));
			
			//If we want to grant all privileges on all resources
			if($resources === true){
				
				//Allow all privileges
				$this->acl->allow($role);
				
			//Else if we have specific privileges for the role
			} elseif(is_array($resources)) {			
			
				//Create each resource permissions
				foreach ($resources as $resource => $permissions){
					
					//Add resource permissions of the role
					$this->acl->allow($role, $resource, $permissions);
				}				
			}			
		}
	}	
	
	/**
	 * Check is the user is allowed to the resource on the privilege
	 * @param string $resource
	 * @param string $privilege
	 * @return bool|Redirect
	 */
	public function isAllowed($resource = null, $privilege = null){
		
		//Reset response
		$this->_response = null;
		
		//Get the current logged user roles
		$roles = Auth::user()->getRoles();
		
		//Check each role if one of them was allowed
		foreach ($roles as $role) {
			if($this->acl->isAllowed($role, $resource, $privilege)){
				return true;
			}
		}
		
		//Set the response
		$this->_response = Redirect::to(Config::get('firadmin::route.login'))->with('reason', Lang::get('firadmin::admin.messages.insufisant-permission') . '<br>')->with('error', 1);
		
		return false;
	}
	
	/**
	 * Get the response
	 * 
	 * @return Reponse
	 */
	public function getResponse(){
		return $this->_response;
	}
}