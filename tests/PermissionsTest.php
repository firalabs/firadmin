<?php

namespace FiradminTests;

use PHPUnit_Framework_TestCase;
use Mockery as m;
use Firalabs\Firadmin\Permissions;

/**
 * Test case for permission library
 * 
 * @author maxime.beaudoin
 */
class PermissionsTest extends PHPUnit_Framework_TestCase
{

	/**
	 * Teardown
	 */
	public function tearDown()
	{
		m::close();
	}

	/**
	 * Resources we want to tests
	 * 
	 * @var array
	 */
	protected $_resources = array (
		'user' 
	);

	/**
	 * Roles we want to tests
	 * 
	 * @var array
	 */
	protected $_roles = array (
		'administrator' => true, 
		'user_administrator' => array (
			'user' => array ('create', 'read', 'update', 'delete') 
		) 
	);

	/**
	 * testAdministratorIsAllowed
	 */
	public function testAdministratorIsAllowed()
	{
		//Mock the user repository
		$mock = m::mock('Firalabs\Firadmin\Repository\Eloquent\UserRepository');
		$mock->shouldReceive('getRoles')->once()->andReturn(array ('administrator' ));
		
		//Test permission
		$permissions = new Permissions($this->_roles, $this->_resources);
		$this->assertTrue($permissions->isAllowed($mock, 'user', 'update'));
	}

	/**
	 * testGuestIsNotAllowed
	 */
	public function testGuestIsNotAllowed()
	{
		//Mock the user repository
		$mock = m::mock('Firalabs\Firadmin\Repository\Eloquent\UserRepository');
		$mock->shouldReceive('getRoles')->once()->andReturn(array ());
		
		//Test permission
		$permissions = new Permissions($this->_roles, $this->_resources);
		$this->assertFalse($permissions->isAllowed($mock, 'user', 'update'));
	}

	/**
	 * testUserAdministatorIsAllowed
	 */
	public function testUserAdministatorIsAllowed()
	{
		//Mock the user repository
		$mock = m::mock('Firalabs\Firadmin\Repository\Eloquent\UserRepository');
		$mock->shouldReceive('getRoles')->once()->andReturn(array ('user_administrator' ));
		
		//Test permission
		$permissions = new Permissions($this->_roles, $this->_resources);
		$this->assertTrue($permissions->isAllowed($mock, 'user', 'update'));
	}
}