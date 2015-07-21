<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	//
	protected $table = 'users';
	public $timestamps = false;
	protected $primaryKey = 'account_id';

    public function scopeofText($query,$text)
    {
        return $query->where('personaname', 'like', '%'.$text.'%')->orWhere('account_id', 'like', '%'.$text.'%');
    }

}
