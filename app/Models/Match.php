<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class match extends Model
{
    protected $table = 'matches';
    public $timestamps = false;
    //
    public function scopeOfSkill($query, $skill)
    {
        return $query->where('skill', '=', $skill);
    }
}
