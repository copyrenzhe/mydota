<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'item';
	public $timestamps = false;
	public $incrementing = false;
	//
    public function scopeofType($query,$type)
    {
        return $query->where('id','<','500')->where('qual','=',$type);
    }

}
