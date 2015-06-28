<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('account_id');
			$table->primary('account_id');
			$table->string('personaname',50);
			$table->string('steamid',64);
			$table->string('avatar',200);
			$table->string('profileurl',128);
			$table->tinyInteger('is_personaname_real')->default(0);
			$table->tinyInteger('is_subscribe')->default(1);
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
