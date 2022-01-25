<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\HireRequest;
use App\Models\User;

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

            $rural_farmers = collect([]);
            $hirerequests = HireRequest::where('urban_farmer_id', auth()->user()->id)->get();
            foreach ($hirerequests as $request) {
                if ($request->status == "Accepted") {
                    $farmer = User::find($request->rural_farmer_id);
                    $rural_farmers->push($farmer);
                }
            }

            return view('urban-farmer.dashboard')->with('rural_farmers', $rural_farmers);
        } else if (Gate::allows('is-rural-farmer')) {

            $urban_farmers = collect([]);
            $hirerequests = HireRequest::where('rural_farmer_id', auth()->user()->id)->get();
            foreach ($hirerequests as $request) {
                if ($request->status == "Accepted") {
                    $farmer = User::find($request->urban_farmer_id);
                    $urban_farmers->push($farmer);
                }
            }

            return view('rural-farmer.dashboard')->with('urban_farmers', $urban_farmers);
        } else if (Gate::allows('is-agro-company')) {
            return view('agro-company.dashboard');
        }

        return view('guests.dashboard');
    }
}
