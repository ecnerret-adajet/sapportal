<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetsystem extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function missings(){
    	return $this->belongsToMany('App\Missing');
    }
}
