<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\SapuserManagementToFunctionalSuccessNotification;
use App\Notifications\SapuserManagementToFunctionalFailedNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests;
use App\Http\Requests\SapuserManagementRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use Flashy;
use App\SapuserManagement;
use App\Sapuser;
use App\User;
use App\Status;

class SapuserManagementsController extends Controller
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
        $statuses = Status::pluck('name','id');
        $sapuser = Sapuser::findOrFail($id);
        $users = User::whereHas('roles', function($q){
            $q->where('id',3);
        })->pluck('name','id');


        return view('sapusers.sapuser_managements', compact('statuses',
            'sapuser','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, SapuserManagementRequest $request)
    {
        $sapuserManagement = Auth::user()->sapuserManagements()->create($request->all());
        $sapuserManagement->statuses()->attach($request->input('status_list'));
        $sapuserManagement->users()->attach($request->input('user_list'));

        $sapuser = Sapuser::findOrFail($id);
        $sapuserManagement->sapuser()->associate($sapuser);
        $sapuser->sapuserManagements()->save($sapuserManagement);

        /**
         * Notify requester for final status for approval
         */
        foreach($sapuserManagement->statuses as $status){
            if($status->id == 1){
        Notification::send($sapuserManagement->users, new SapuserManagementToFunctionalSuccessNotification($sapuserManagement));
            }else{
        Notification::send($sapuser->user, new SapuserManagementToFunctionalFailedNotification($sapuserManagement));
            }
        }

        flashy()->success('Succefully Updated !');
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
