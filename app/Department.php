<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function sapusers(){
    	return $this->belongsToMany('App\Sapuser');
    }
}
