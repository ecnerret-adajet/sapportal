<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\SapuserFunctionalToManagementSuccessNotification;
use App\Notifications\SapuserFunctionalToManagementFailedNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests;
use App\Http\Requests\SapuserFunctionalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use App\Sapuser;
use App\Status;
use Flashy;
use Carbon\Carbon;
use App\SapuserFunctional;
use App\User;

class SapuserFunctionalsController extends Controller
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
            $q->where('id',4);
        })->pluck('name','id');

        return view('sapusers.sapuser_functionals', compact('statuses',
            'id',
            'users',
            'sapuser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, SapuserFunctionalRequest $request)
    {
        $sapuserFunctional = Auth::user()->sapuserFunctionals()->create($request->all());
        $sapuserFunctional->statuses()->attach($request->input('status_list'));
        $sapuserFunctional->users()->attach($request->input('user_list'));

        $sapuser = Sapuser::findOrFail($id);
        $sapuserFunctional->sapuser()->associate($sapuser);
        $sapuser->sapuserFunctionals()->save($sapuserFunctional);

        /**
         * Notify Management users via email
         */
        foreach($sapuserFunctional->statuses as $status){
            if($status->id == 1){
        Notification::send($sapuserFunctional->users, new SapuserFunctionalToManagementSuccessNotification($sapuserFunctional));
            }else{
        Notification::send($sapuser->user, new SapuserFunctionalToManagementFailedNotification($sapuserFunctional));
            }
        }

        flashy()->success('Successfully updated!');
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
