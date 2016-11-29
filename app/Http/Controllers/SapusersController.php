<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\SapuserToApproverSuccessNotification;
use App\Notifications\SapuserFinalNotificationToRequester;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests;
use App\Http\Requests\SapuserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Sapuser;
use App\Company;
use App\Department;
use App\Sapmodule;
use App\User;
use App\Targetserver;
use Carbon\Carbon;
use DB;
use Flashy;
use App\Status;
use App\FormStatus;

class SapusersController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sapusers = Sapuser::all();
        $targerservers = Targetserver::all();
        $companies = Company::all();
        $departments = Department::all();
        $statuses = Status::all();
        $formStatuses = FormStatus::pluck('name','id');

        return view('sapusers.index', compact('sapusers',
            'formStatuses',
            'companies',
            'departments',
            'statuses',
            'targerservers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('name','id');
        $departments = Department::pluck('name','id');
        $targetservers = Targetserver::pluck('name','id');
        $sapmodules = Sapmodule::pluck('name','id');

        $users = User::whereHas('roles', function($q){
            $q->where('id',2);
        })->pluck('name','id');



        return view('sapusers.create', compact('companies',
            'departments',
            'users',
            'targetservers',
            'sapmodules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SapuserRequest $request)
    {
        $sapuser = Auth::user()->sapusers()->create($request->all());
        $sapuser->companies()->attach($request->input('company_list'));
        $sapuser->departments()->attach($request->input('department_list'));
        $sapuser->targetservers()->attach($request->input('targetserver_list'));
        $sapuser->users()->attach($request->input('user_list'));
        //$sapuser->sapmodules->attach($request->input('sapmodule_list'));

        /**
         * Notify the approver via email notification
         */
        Notification::send($sapuser->users, new SapuserToApproverSuccessNotification($sapuser));

        flashy()->success('Form successfully created!');
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
     * Change form ticket status
     */
    public function status(Request $request, Sapuser $sapuser)
    {
        $this->validate($request, [
            'form_status_list' => 'required'
        ]);
        
        $sapuser->formStatuses()->attach($request->input('form_status_list'));

        Notification::send($sapuser->user, new SapuserFinalNotificationToRequester($sapuser));

        flashy()->success('Form Status Updated Successfully!');
        return redirect('sapusers');
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
