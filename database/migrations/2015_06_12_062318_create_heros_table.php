<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHerosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('heros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('local_name');
			$table->enum('attribute',array('strength,agility,intellect'));
			$table->string('type');
			$table->tinyInteger('strength_init');
			$table->tinyInteger('agility_init');
			$table->tinyInteger('intellect_init');
			$table->float('strength_add');
			$table->float('agility_add');
			$table->float('intellect_add');
			$table->tinyInteger('attack_min');
			$table->tinyInteger('attack_max');
			$table->smallInteger('speed');
			$table->float('turn_speed');
			$table->float('front_cradle');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('heros');
	}

}
