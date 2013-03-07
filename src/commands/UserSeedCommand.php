<?php

namespace Firalabs\Firadmin\Commands;
use Illuminate\Console\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateSeedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'create:user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new user in database';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		
		$user = app()->make('Firalabs\Firadmin\Repository\UserRepositoryInterface');
		
		//Check if the username is already take
		if($user->where('username', '=', $this->argument('username'))->orWhere('email', '=', $this->argument('email'))->first()){
			
			$this->info('<error>The username or the email was already taken.</error>');
			
		//Else we can create the new user !!!
		} else {
		
			//Create user object
			$user = app()->make('Firalabs\Firadmin\Repository\UserRepositoryInterface');
			
			//Set user data
			$user->username = $this->argument('username');
			$user->email    = $this->argument('email');
			$user->password = $this->argument('password');
			
			//Save the user
			$user->forceSave();		
			
			//If we have roles
			if($this->option('role')){
			
				//Create role
				$roles = app()->make('Firalabs\Firadmin\Repository\UserRoleRepositoryInterface');		
				$roles->role = $this->option('role');		
			
				//Save the user role
				$user->roles()->save($roles);
			}
			
			$this->info('<info>User ' . $this->argument('username') . ' added.</info>');
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('username', InputArgument::REQUIRED, 'The username'),
			array('email',    InputArgument::REQUIRED, 'The email'),
			array('password', InputArgument::REQUIRED, 'The user password')
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('role', null, InputOption::VALUE_OPTIONAL, 'The user role', null),
		);
	}
}