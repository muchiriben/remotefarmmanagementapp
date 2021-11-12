<?php

namespace App\Http\Controllers\Urban;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HireRequest;
use App\Models\User;
use App\Models\Role;

class UrbanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmers = Role::find(3)->users;
        //dd($farmers);
        return view('requests.index')->with('farmers', $farmers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HireRequest::create([
            'urban_farmer_id' => auth()->user()->id,
            'rural_farmer_id' => $request->rural_farmer,
            'status' => $request->status,
        ]);


        return redirect()->route('urban.requests.show', auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $farmers = Role::find(3)->users;
        $requests = HireRequest::where('urban_farmer_id', $id)->get();
        //dd($requests);
        return view('requests.urban-requests')->with(['requests' => $requests, 'farmers' => $farmers]);
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
