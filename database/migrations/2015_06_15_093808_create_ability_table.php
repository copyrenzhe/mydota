<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ability', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dname');
            $table->string('name');
            $table->text('affects');
            $table->text('desc');
            $table->text('notes');
            $table->text('dmg');
            $table->text('attrib');
            $table->text('cmb');
            $table->text('lore');
            $table->string('hurl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ability');
    }
}
