<?php

namespace FiradminTests;

use PHPUnit_Framework_TestCase;
use Mockery as m;
use Firalabs\Firadmin\AjaxRequest;

/**
 * Test case for ajax request library
 * 
 * @author maxime.beaudoin
 */
class AjaxRequestTest extends PHPUnit_Framework_TestCase
{

	/**
	 * Teardown
	 */
	public function tearDown()
	{
		m::close();
	}

	/**
	 * testIsAjaxFromHeader
	 */
	public function testIsAjaxFromHeader()
	{
		//Mock the user repository
		$mock = m::mock('Illuminate\Http\Request');
		$mock->shouldReceive('input');
		$mock->shouldReceive('ajax')->once()->andReturn(true);
		
		//Test request
		$request = new AjaxRequest($mock);
		$this->assertTrue($request->isAjax());
	}

	/**
	 * testIsAjaxFromInput
	 */
	public function testIsAjaxFromInput()
	{
		//Mock the user repository
		$mock = m::mock('Illuminate\Http\Request');
		$mock->shouldReceive('input')->once()->andReturn('ajax');
		$mock->shouldReceive('ajax');
		
		//Test request
		$request = new AjaxRequest($mock);
		$this->assertTrue($request->isAjax());
	}

	/**
	 * testIsNotAjax
	 */
	public function testIsNotAjax()
	{
		//Mock the user repository
		$mock = m::mock('Illuminate\Http\Request');
		$mock->shouldReceive('input')->once()->andReturn(null);
		$mock->shouldReceive('ajax')->once()->andReturn(false);
		
		//Test request
		$request = new AjaxRequest($mock);
		$this->assertFalse($request->isAjax());
	}
}