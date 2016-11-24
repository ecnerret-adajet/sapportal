<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\MissingGrantNotification;
use App\Notifications\MissingDenyNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use App\User;
use App\Management;
use App\Status;
use Carbon\Carbon;
use App\Missing;
use Flashy;
use DB;

class MissingManagementsController extends Controller
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
    
        return view('missings.missing_management', compact(
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
     public function store($id, Request $request)
    {
        $this->validate($request, [
            'name',
            'approver_date'
        ]);

        $management = Auth::user()->managements()->create($request->all());
        $management->statuses()->attach($request->input('status_list'));

        $missing = Missing::findOrFail($id);
        $management->missing()->associate($missing);
        $missing->management()->save($management);

        /**
         * Notify the requester if the form is approved or deny
         */
        foreach($management->statuses as $status){
            if($status->id == 1){
    Notification::send($missing->user, new MissingGrantNotification($management));
            }else{
    Notification::send($missing->user, new MissingDenyNotification($management));            
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