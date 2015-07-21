<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Match;

class Slot extends Model {

	//
    protected $table = 'slots';
    public $timestamps = false;

    public function hasOneMatch()
    {
        return $this->hasOne('\App\Models\Match','match_id','match_id');
    }

}
