<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use App\Sapuser;
use App\SapuserApprover;
use Carbon\Carbon;
use Flashy;
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
        return view('sapusers.sapuser_approvers', compact(
            'id',
            'sapuser',
            'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $sapuserApprover = Auth::user()->sapuserApprovers()->create($request->all());
        $sapuserApprover->statuses()->attach($request->input('status_list'));

        $sapuser = Sapuser::findOrFail($id);
        $sapuserApprover->sapuser()->associate($sapuser);
        $sapuser->sapuserApprovers()->save($sapuserApprover);

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
