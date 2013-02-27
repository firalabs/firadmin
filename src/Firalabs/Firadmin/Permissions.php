<?php namespace Firalabs\Firadmin;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Illuminate\Support\Facades\Config;

class Permissions {
	
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
	 * (non-PHPdoc)
	 * @see Zend\Permissions\Acl\Acl::isAllowed()
	 */
	public function isAllowed($role = null, $resource = null, $privilege = null){
		return $this->acl->isAllowed($role, $resource, $privilege);
	}
}