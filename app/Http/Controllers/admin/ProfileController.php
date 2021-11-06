<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Str;
use Session;
use Gate;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\Models\User::where('id', Auth::user()->id)->get();
        // $user = User::where('id', Auth::user()->id)->get();
        return view('admin.profile.index')
                    ->with('users', User::orderBy('id', 'asc')->get())
                    ->with('profile', $user)
                    ->with('page', 'Profile');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
            'phone' => 'min:9|max:12',
        ]);

        $request->merge(['slug' => Str::slug($request->email)]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);
        // auth()->user()->User()->create($input);

        Session::flash('success', 'New user has been added successfully');
        return redirect()->back();
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
        $user = User::where('slug', $id)->first();
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'phone' => 'min:9|max:12',
        ]);

        $request->merge(['slug' => Str::slug($request->email)]);

        if($request->password || $request->confirm_password){
            $request->validate([
                'password' => 'required|min:8|max:255',
                'confirm_password' => 'required|same:password|min:8'
            ]);
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        $input = $request->except('password');
        $user->update($input);

        Session::flash('success', 'User profile has been updated successfully');
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::where('slug', $id)->first();
        $user->delete();
        Session::flash('success', 'Profile has been deleted successfully');
    }
}
