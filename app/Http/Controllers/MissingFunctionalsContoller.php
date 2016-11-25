<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\MissingFunctionalToManagementFailedNotification;
use App\Notifications\MissingFunctionalToManagementSuccessNotification;
use App\Http\Requests;
use App\Http\Requests\MissingFunctionalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Illuminate\Support\Facades\Notification;
use Flashy;
use App\User;
use App\Missing;
use App\Functional;
use Carbon\Carbon;
use App\Status;
use DB;


class MissingFunctionalsContoller extends Controller
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
            $q->where('id','4');
        })->pluck('name','id');

        return view('missings.missing_functional', compact(
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
    public function store($id, MissingFunctionalRequest $request)
    {

        $functional = Auth::user()->functionals()->create($request->all());
        $functional->statuses()->attach($request->input('status_list'));
        $functional->users()->attach($request->input('user_list'));

        $missing = Missing::findOrFail($id);
        $missing->functional()->save($functional);

        /**
         * Notify management user role: who will selected as approver
         */
        foreach($functional->statuses as $status){
            if($status->id == 1){
            Notification::send($functional->users, new MissingFunctionalToManagementSuccessNotification($functional));
            }else{
            Notification::send($missing->user, new MissingFunctionalToManagementFailedNotification($functional));
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
