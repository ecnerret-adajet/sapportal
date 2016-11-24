<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\MissingToApproverSuccessNotification;
use App\Http\Requests\MissingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection;
use App\Http\Requests;
use App\Targetsystem;
use App\Targetserver;
use App\Management;
use App\Functional;
use Carbon\Carbon;
use App\Approver;
use App\Missing;
use App\Status;
use App\User;
use Flashy;
use Image;
use DB;



class MissingsController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missings = Missing::all();
        $targersystems = Targetsystem::all();
        $targerservers = Targetserver::all();        
        $statuses = Status::all();
        return view('missings.index', compact('missings',
            'approvers',
            'statuses',
            'targerservers',
            'targersystems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $targetsystems = Targetsystem::pluck('name','id');
        $targetservers = Targetserver::pluck('name','id');

        $users = User::whereHas('roles', function($q){
            $q->where('id', 2);
        })->pluck('name','id');

        return view('missings.create', compact('targetservers',
            'users',
            'targetsystems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MissingRequest $request)
    {   
        $missing = Auth::user()->missings()->create($request->all());
        $missing->targetservers()->attach($request->input('targetserver_list'));
        $missing->targetsystems()->attach($request->input('targetsystem_list'));
        $missing->users()->attach($request->input('user_list'));
        if($request->hasFile('screen_shot')){
            $screen_shot = $request->file('screen_shot');
            $filename = time() . '.' .$screen_shot->getClientOriginalExtension();
            Image::make($screen_shot)->resize(500,500)->save( public_path('/img/missing_authorization/' . $filename ) );  
            $missing->screen_shot = $filename;
            $missing->save();
        }
        /**
         * notify user an emal
         */

        Notification::send($missing->users, new MissingToApproverSuccessNotification($missing));


        flashy()->success('Successfully submitted a missing authorization!');
        return redirect('missings');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Missing $missing)
    {
        $missings = Missing::all();
        return view('missings.show');
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
