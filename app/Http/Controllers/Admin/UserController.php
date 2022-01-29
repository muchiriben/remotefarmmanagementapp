<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.users.index')->with('users', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'national_id' => ['integer', 'unique:users'],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'password' => ['required', Rules\Password::defaults()],
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

        $user->roles()->sync('4');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')
            ->with([
                'roles' => $roles,
                'user' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //handle file if uploaded
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
            $user->profile_image = $fileNameToStore;
            //delete previuos
            Storage::delete('public/profile_image/' . $user->id . '/' . $request->input('old_profile_image'));
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->national_id = $request->national_id;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();

        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
