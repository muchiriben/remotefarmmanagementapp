<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (Gate::allows('is-admin')) {
            return view('admin.dashboard');
        } else if (Gate::allows('is-urban-farmer')) {
            return view('urban-farmer.dashboard');
        } else if (Gate::allows('is-rural-farmer')) {
            return view('rural-farmer.dashboard');
        } else if (Gate::allows('is-agro-company')) {
            return view('agro-company.dashboard');
        }

        return view('guests.dashboard');
    }
}
