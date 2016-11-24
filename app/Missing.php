<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Missing extends Model
{

    use Notifiable;

    protected $fillable = [
        'requested_by',
        'request_date',
        'screen_shot',
        'authorization_details',
    ];

    protected $dates = [
        'request_date',
    ];

    /* list user id */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * list users that will approved a missing authorization form
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function getUserListAttribute()
    {
        return $this->users->pluck('id')->all();
    }


    /**
     * Get approver that belongs to missing authoriztion form
     */

    public function approver()
    {
        return $this->hasMany('App\Approver');
    }

    /**
     * Get function that belongs to missing authorization form
     */

    public function functional()
    {
        return $this->hasMany('App\Functional');
    }

    /**
     * Get management that belongs to missing authorization form
     */

    public function management()
    {
        return $this->hasMany('App\Management');
    }


    /* list request dates */
    public function setRequesteDateAttribute($date)
    {
        $this->attributes['request_date'] = Carbon::parse($date);
    }
    
    public function getRequesteDateAttribute($date)
    {
        return new Carbon($date);
    }

    /* list target sysetm here */

    public function targetsystems()
    {
    	return $this->belongsToMany('App\Targetsystem')->withTimestamps();
    }

    public function getTargetsystemListAttribute(){
    	return $this->targetsystems->pluck('id')->all();
    }

    /* list all target server */

    public function targetservers(){
        return $this->belongsToMany('App\Targetsystem')->withTimestamps();
    }

    public function getTargetserverListAttribute(){
        return $this->targetservers->pluck('id')->all();

    }

    /**
     * get id from url
     */
    public static function locatedAt($id)
    {
          return static::where(compact('id'))->firstOrFail();
    }

}
