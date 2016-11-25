<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\MissingApproverToFunctionalFailedNotification;
use App\Notifications\MissingApproverToFunctionalSuccessNotification;
use App\Http\Requests;
use App\Http\Requests\MissingApproverRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Role;
use App\Approver;
use App\Missing;
use App\Status;
use Carbon\Carbon;
use Flashy;
use DB;


class MissingApproversControllers extends Controller
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
        $missing = Missing::findOrFail($id);
        $statuses = Status::pluck('name','id');

        $users = User::whereHas('roles', function($q){
            $q->where('id', 3);
        })->pluck('name','id');

        return view('missings.missing_approver', compact(
            'users',
            'id',
            'statuses',
            'missing'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, MissingApproverRequest $request)
    {

        $approver = Auth::user()->approvers()->create($request->all());
        $approver->statuses()->attach($request->input('status_list'));
        $approver->users()->attach($request->input('user_list'));

        $missing = Missing::findOrFail($id);
        $approver->missing()->associate($missing);
        $missing->approver()->save($approver);

        /**
         * Notify the approver via email
         */
        foreach($approver->statuses as $status){
            if($status->id == 1){
 Notification::send($approver->users, new MissingApproverToFunctionalSuccessNotification($approver));
            }else{
  Notification::send($missing->user, new MissingApproverToFunctionalFailedNotification($approver));               
            }
        }
       
       

        flashy()->success('Successfully Approved!');
        return redirect('missings');
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
