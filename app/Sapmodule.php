<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sapmodule extends Model
{
    protected $fillable = [
    	'name',
    	'display_name'
    ];

    /* list all user to sapmodule */
    public function users(){
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function getUserListAttribute(){
    	return $this->users->pluck('id')->all();
    }

    /* list sapmodule to sap user creation module */
    public function sapusers(){
    	return $this->belongsToMany('App\Sapuser');
    }

}
