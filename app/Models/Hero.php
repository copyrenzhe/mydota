<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model {

	//
	protected $table = 'heros';
	public $timestamps = false;
	protected $fillable = ['name','localized_name','type','attribute','strength_add','intellect_add','agility_add','strength_init','intellect_init','attack_min','attack_max','agility_init','speed','turn_speed','front_cradle'];

}
