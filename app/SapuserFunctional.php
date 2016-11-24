<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SapuserFunctional extends Model
{
    protected $table = 'sapuser_functionals';

    protected $fillable = [
    	'name',
    	'comment',
    	'approved_date'
    ];

    protected $dates = [
    	'approved_date'
    ];

    /**
     * Format approved date attribute
     */
    public function setApprovedDateAttribute($date)
    {
    	$this->attributes['approved_date'] = Carbon::parse($date);
    }

    public function getApprovedDateAttribute($date)
    {
    	return new Carbon($date);
    }

    /**
     * Show user create a post
     */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Bind to creat with sap user creation data
     */

    public function sapuser()
    {
    	return $this->belongsTo('App\Sapuser');
    }

    /**
     * Approver may deny or approved a requester
     */

    public function statuses()
    {
    	return $this->belongsToMany('App\Status', 'sapuser_functional_status', 'sapuser_functional_id', 'status_id')->withTimestamps();
    }

    public function getStatusListAttribute()
    {
    	return $this->statuses->pluck('id')->all();
    }
}
