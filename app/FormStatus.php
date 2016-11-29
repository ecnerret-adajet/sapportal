<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormStatus extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function missings()
    {
    	return $this->belongsToMany('App\Missing','form_status_missing','form_status_id','missing_id');
    }

    public function sapusers()
    {
    	return $this->belongsToMany('App\Sapuser','form_status_sapuser','form_status_id','sapuser_id');
    }
}
