<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SapuserApprover extends Model
{
	protected $table = 'sapuser_approvers';

    protected $fillable = [
    	'name',
    	'comment',
    	'approved_date'
    ];

    protected $dates = [
    	'approved_date'
    ];

    /**
     * Show user create a post
     */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Bind to create with sapuser data
     */

    public function sapuser()
    {
    	return $this->belongsTo('App\Sapuser');
    }

    /**
     * Format approved date attributes
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
     * Approver has ability to approved or deny a requester
     */

    public function statuses()
    {
    	return $this->belongsToMany('App\Status','sapuser_approver_status','sapuser_approver_id','status_id')->withTimestamps();
    }
    public function getStatusListAttribute()
    {
    	return $this->statuses->pluck('id')->all();
    }


}
