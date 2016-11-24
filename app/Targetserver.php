<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetserver extends Model
{
    protected $fillable= [
    	'name'
    ];

    public function missings(){
    	return $this->belongsToMany('App\Missing');
    }

    public function sapusers(){
    	return $this->belongsToMany('App\Sapuser');
    }

}
