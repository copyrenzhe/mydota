<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    //
    protected $table = 'ability';
    public $timestamps = false;
    protected $fillable = array('dname','name','affects','desc','notes','dmg','attrib','cmb','lore','hurl');
}
