<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SapuserManagement extends Model
{
    protected $table = 'sapuser_managements';

    use Notifiable;

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
     * Show user who created a post
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    /**
     * Bind sapuser data to sapuserManagement when storing
     */
    public function sapuser()
    {
    	return $this->belongsTo('App\Sapuser');
    }

    /**
     * Management can approved or deny a  requester
     */

    public function statuses()
    {
    	return $this->belongsToMany('App\Status', 'sapuser_management_status', 'sapuser_management_id', 'status_id')->withTimestamps();
    }

    public function getStatusListAttribute()
    {
    	return $this->statuses->pluck('id')->all();
    }






}
