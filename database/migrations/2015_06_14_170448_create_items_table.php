<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item', function(Blueprint $table)
		{
			$table->integer('id');
			$table->primary('id');
			$table->string('name');
			$table->string('img');
			$table->string('dname');
			$table->string('qual');
			$table->integer('cost');
			$table->text('desc');
			$table->text('notes');
			$table->text('attrib');
			$table->integer('mc');
			$table->integer('cd');
			$table->text('lore');
			$table->string('components')->nullable();
			$table->boolean('created');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item');
	}

}
