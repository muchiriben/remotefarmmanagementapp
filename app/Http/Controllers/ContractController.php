<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\HireRequest;

class ContractController extends Controller
{
    public function upload(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $request->validate([
            'contract' => 'required|max:2048',
        ]);

        //handle file if uploaded
        if ($request->hasFile('contract')) {
            //get filename with extension
            $fileNameWithExt = $request->file('contract')->getClientOriginalName();
            //get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('contract')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = $request->file('contract')->storeAs('public/contracts',  auth()->user()->id . '/' . $fileNameToStore);
            $user->contract = $fileNameToStore;
            $user->update();
        }

        return redirect()->route('urban.requests.index');
    }

    public function download($id)
    {
        $urban = User::find($id);
        return Storage::download('public/contracts/' . $urban->id . '/' . $urban->contract);
    }

    public function ruralContract()
    {
        $urban_farmers = collect([]);
        $hirerequests = HireRequest::where('rural_farmer_id', auth()->user()->id)->get();
        foreach ($hirerequests as $request) {
            if ($request->status == "Accepted") {
                $farmer = User::find($request->urban_farmer_id);
                $urban_farmers->push($farmer);
            }
        }

        return view('rural-farmer.contract')->with('urban_farmers', $urban_farmers);
    }

    public function ruralupload(Request $request)
    {

        $request->validate([
            'contract' => 'required|max:2048',
        ]);

        //handle file if uploaded
        if ($request->hasFile('contract')) {
            //get filename with extension
            $fileNameWithExt = $request->file('contract')->getClientOriginalName();
            //get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('contract')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = $request->file('contract')->storeAs('public/contracts',  auth()->user()->id . '/' . $request->urban_farmer . '/' . $fileNameToStore);
        }

        return redirect()->route('dashboard');
    }

    public function urbanDownload($id)
    {
        $rural = User::find($id);
        $contracts = Storage::allFiles('public/contracts/' . $rural->id . '/' . '/' . auth()->user()->id);

        foreach ($contracts as $contract) {
            return Storage::download($contract);
        }
    }
}
