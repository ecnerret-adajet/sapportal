<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use App\Notifications\SapuserApproverToManagementSuccessNotification;
use App\Notifications\SapuserApproverToManagementFailedNotification;
use App\Http\Requests;
use App\Http\Requests\SapuserApproverRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use App\Sapuser;
use App\SapuserApprover;
use Carbon\Carbon;
use Flashy;
use App\User;
use App\Status;



class SapuserApproversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $sapuser = Sapuser::findOrFail($id);
        $statuses = Status::pluck('name','id');
        $users = User::whereHas('roles', function($q){
            $q->where('id',4);
        })->pluck('name','id');

        return view('sapusers.sapuser_approvers', compact(
            'id',
            'users',
            'sapuser',
            'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, SapuserApproverRequest $request)
    {
        $sapuserApprover = Auth::user()->sapuserApprovers()->create($request->all());
        $sapuserApprover->statuses()->attach($request->input('status_list'));
        $sapuserApprover->users()->attach($request->input('user_list'));

        $sapuser = Sapuser::findOrFail($id);
        $sapuserApprover->sapuser()->associate($sapuser);
        $sapuser->sapuserApprovers()->save($sapuserApprover);

        /**
         * Notify Management user via email
         */
        foreach($sapuserApprover->statuses as $status){
            if($status->id == 1){
Notification::send($sapuserApprover->users, new SapuserApproverToManagementSuccessNotification($sapuserApprover));
            }
            else{
Notification::send($sapuser->user, new SapuserApproverToManagementFailedNotification($sapuserApprover));
            }
        }
        flashy()->success('Approved successfully!');
        return redirect('sapusers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
