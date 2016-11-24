<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
    	'name',
    ];




    /**
     * refernce status model to sap user approvers table
     */

    public function sapuserApprovers()
    {
        return $this->belongsToMany('App\SapuserApprover','sapuser_approver_status','status_id','sapuser_approver_id');
    }


    /**
     * Reference status model to sap user functional table
     */
    public function sapuserFunctionals()
    {
        return $this->belongsToMany('App\SapuserFunctional','sapuser_functional_status','status_id','sapuser_functional_id');
    }


    /**
     * Reference status mode to sap  user managenent table
     */

    public function sapuserManagements()
    {
        return $this->belongsToMany('App\SapuserManagement', 'sapuser_management_status', 'status_id', 'sapuser_management_id');
    }


    /**
     * Reference status model to approvers model
     */

    public function approvers()
    {
    	return $this->belongsToMany('App\Approver');
    }

    /**
     * Management has ability to approve or deny a requester
     */

    public function managements()
    {
    	return $this->belongsToMany('App\Management');
    }

    /**
     * Functional members has an ability to approve or deny a requester
     */

    public function functionals()
    {
    	return $this->belongsToMany('App\Functional');
    }


}
