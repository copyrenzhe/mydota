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
			$table->string('name');		//antimage
			$table->string('dname');	//敌法师
			$table->enum('pa',array('str,agi,int'));		//agi
			$table->string('u');		//Anti-Mage
			$table->string('droles');	//核心 - 逃生
			$table->tinyInteger('str_b');	//base strength
			$table->tinyInteger('agi_b');	//base agility
			$table->tinyInteger('int_b');	//base intellect
			$table->string('armor');
			$table->float('str_g');		//gain strength
			$table->float('agi_g');		//gain agility
			$table->float('int_g');		//gain intellect
			$table->tinyInteger('dmg_min');
			$table->tinyInteger('dmg_max');
			$table->smallInteger('ms');		//290
			$table->string('dac');	//近战
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
