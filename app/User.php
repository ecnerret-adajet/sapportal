<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /* list user to sap module */
    public function sapmodules(){
        return $this->belongsToMany('App\Sapmodule');
    }

    /* list missing to user */
    public function missings(){
        return $this->hasMany('App\Missing');
    }

    /* list sapuser to user */
    public function sapusers(){
        return $this->hasMany('App\Sapuser');
    }

    public function functionals(){
        return $this->hasMany('App\Functional');
    }

    public function managements()
    {
        return $this->hasMany('App\Management');
    }

    public function approvers()
    {
        return $this->hasMany('App\Approver');
    }

    public function sapuserApprovers()
    {
        return $this->hasMany('App\SapuserApprover');
    }

    public function sapuserFunctionals()
    {
        return $this->hasMany('App\SapuserFunctional');
    }

    public function sapuserManagements()
    {
        return $this->hasMany('App\SapuserManagement');
    }

    /**
     * reference user table to missing authorization form
     */
    public function missingsList()
    {
        return $this->belongsToMany('App\Missing');
    }

    /**
     * reference user table to missing authorization form: approval status
     */
    public function approversList()
    {
        return $this->belongsToMany('App\Approver');
    }

    /**
     * reference user table to missing authorization form: approval functional
     */
    public function functionalsList()
    {
        return $this->belongsToMany('App\Functional');
    }


}
