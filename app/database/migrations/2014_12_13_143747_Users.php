<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table)
		{
			$table -> increments('id');
			$table -> string('email','60');
			$table -> string('username','60');
			$table -> string('password','60');
			$table -> string('password_temp','60');
			$table -> string('code');
			$table -> integer('active');
			$table -> string('remember_token','100');
			$table ->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');

	}

}
