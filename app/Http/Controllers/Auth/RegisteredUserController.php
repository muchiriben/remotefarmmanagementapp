<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'national_id' => ['integer', 'unique:users'],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'description' => $request->description,
            'location' => $request->location,
            'password' => Hash::make($request->password),
        ]);

        //handle if uploaded
        if ($request->hasFile('profile_image')) {
            //get filename with extension
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            //get just filename
            $filename  = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = $request->file('profile_image')->storeAs('public/profile_image',  $user->id . '/' . $fileNameToStore);
            //update
            $user->update(['profile_image' => $fileNameToStore]);
        }

        $user->roles()->sync($request->roles);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
