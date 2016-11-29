<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sapuser extends Model
{

    use Notifiable;

    protected $fillable = [
        'requested_by',
    	'requested_date',
    	'sap_username',
    	'first_name',
    	'middle_initial',
    	'last_name',
    	'email',
    	'tel_num',
    	'user_role',
    	'valid_from',
    	'valid_to',
    	'requested_comment',

    ];

    protected $dates = [
    	'requested_date',
    	'valid_from',
    	'valid_to',
    ];

    /* list users */

    public function user(){
    	return $this->belongsTo('App\User');
    }


    /**
     * list users who will approve the Sap user creation form
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
    public function sapuserApprovers()
    {
        return $this->hasMany('App\SapuserApprover');
    }

    /**
     * Get user who approved from user creation form
     */

    public function sapuserFunctionals()
    {
        return $this->hasMany('App\SapuserFunctional');
    }

    /**
     * Ger user who approved from user creation form
     */
    public function sapuserManagements()
    {
        return $this->hasMany('App\SapuserManagement');
    }


    /* list request date */
    public function setRequestedDateAttribute($date)
    {
        $this->attributes['requested_date'] = Carbon::parse($date);
    }
    
    public function getRequestedDateAttribute($date)
    {
        return new Carbon($date);
    }


    /* list valid from date */
    public function setValidFromAttribute($date)
    {
        $this->attributes['valid_from'] = Carbon::parse($date);
    }
    
    public function getValidFromAttribute($date)
    {
        return new Carbon($date);
    }

     /* list valid to date */
    public function setValidToAttribute($date)
    {
        $this->attributes['valid_to'] = Carbon::parse($date);
    }
    
    public function getValidToAttribute($date)
    {
        return new Carbon($date);
    }

   
    /* list company */
    public function companies(){
    	return $this->belongsToMany('App\Company')->withTimestamps();
    }

    public function getCompanyListAttribute(){
    	return $this->companies->pluck('id')->all();
    }

    /* list all departments */
    public function departments(){
    	return $this->belongsToMany('App\Department')->withTimestamps();
    }

    public function getDepartmentListAttribute(){
    	return $this->departments->pluck('id')->all();
    }

    /* list all target server */
    public function targetservers(){
    	return $this->belongsToMany('App\Targetserver')->withTimestamps();
    }

    public function getTargetserverListAttribute(){
    	return $this->targetservers->pluck('id')->all();
    }

    /* list sapmodule to sapuser table */
    public function sapmodules(){
        return $this->belongsToMany('App\Sapmodule')->withTimestamps();
    }

    public function getSapmoduleListAttribute(){
        return $this->sapmodules->pluck('id')->all();
    } 

    /**
     * Get form status
     */
    public function formStatuses()
    {
      return $this->belongsToMany('App\FormStatus', 'form_status_sapuser', 'sapuser_id','form_status_id')->withTimestamps();   
    }

    public function getFormStatusListAttribute()
    {
        return $this->formStatuses->pluck('id')->all();
    }

}
