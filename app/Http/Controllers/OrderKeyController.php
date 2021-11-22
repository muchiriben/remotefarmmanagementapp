<?php

namespace App\Http\Controllers;

use App\Models\OrderKey;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderKeys = OrderKey::paginate(7);

        return view('agro-company.orders.index')->with('orderKeys', $orderKeys);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderKey  $orderKey
     * @return \Illuminate\Http\Response
     */
    public function show(OrderKey $orderKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderKey  $orderKey
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderKey $orderKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderKey  $orderKey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderKey $orderKey)
    {
        $orderKey->status = $request->status;
        $orderKey->save();

        return redirect()->route('order-keys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderKey  $orderKey
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderKey $orderKey)
    {
        //
    }
}
