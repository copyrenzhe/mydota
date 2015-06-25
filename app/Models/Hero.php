<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model {

	//
	protected $table = 'heros';
	public $timestamps = false;
	protected $fillable = array('name','dname','pa','u','droles','str_b','agi_b','int_b','armor','str_g','agi_g','int_g','dmg_min','dmg_max','ms','dac');

	public function scopeofType($query,$type)
    {
        return $query->where('pa','=',$type);
    }

}
