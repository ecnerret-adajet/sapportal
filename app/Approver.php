<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Approver extends Model
{
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
     * Show user create a post
     */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * list user who will received the approver's notification
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
     * bind to create with missing data
     */
    public function missing()
    {
    	return $this->belongsTo('App\Missing');
    }

    /**
     * bind to create with sap user creation form
     */
    public function sapuser()
    {
    	return $this->belongsTo('App\Sapuser');
    }


    /**
     * format approved date attribute
     */

    public function setApprovedDateAttribute($date)
    {
    	$this->attributes['approved_date'] = Carbon::parse($date);
    }

    public function getAppovedDateAttribute($date)
    {
    	return new Carbon($date);
    }

    /**
     * Approver has ability to approve or deny an requester
     */

    public function statuses()
    {
        return $this->belongsToMany('App\Status')->withTimestamps();
    }

    public function getStatusListAttribute()
    {
        return $this->statuses->pluck('id')->all();
    }

    /**
     * get id from
     */
    public static function locatedAt($id)
    {
          return static::where(compact('id'))->firstOrFail();
    }





}
