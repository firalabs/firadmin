<?php

use Illuminate\Database\Migrations\Migration;

class FiralabsFiradminCreateUsersRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_roles', function ($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('role');
			$table->timestamps();		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}