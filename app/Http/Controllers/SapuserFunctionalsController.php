<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use App\Sapuser;
use App\Status;
use Flashy;
use Carbon\Carbon;
use App\SapuserFunctional;

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
        return view('sapusers.sapuser_functionals', compact('statuses',
            'id',
            'sapuser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $sapuserFunctional = Auth::user()->sapuserFunctionals()->create($request->all());
        $sapuserFunctional->statuses()->attach($request->input('status_list'));

        $sapuser = Sapuser::findOrFail($id);
        $sapuserFunctional->sapuser()->associate($sapuser);
        $sapuser->sapuserFunctionals()->save($sapuserFunctional);

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
