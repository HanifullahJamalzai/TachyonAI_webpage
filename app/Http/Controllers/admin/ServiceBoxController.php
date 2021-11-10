<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceBox;
use Session;
use Illuminate\Support\Str;

use App\Models\Inbox;
class ServiceBoxController extends Controller
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
        
        return view('admin.service.box')
                    ->with('serviceboxes', ServiceBox::orderBy('id', 'asc')->get())
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Service-Box');
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
            'title' => 'required|max:50',
            'description' => 'required|max:200'
        ]);
        
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();
        ServiceBox::create($input);
        Session::flash('success', 'ServiceBox has been added successfully');
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
    public function update(Request $request, ServiceBox $servicebox)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:200'
        ]);
        
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();
        $servicebox->update($input);
        Session::flash('success', 'ServiceBox has been updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceBox $servicebox)
    {
        $servicebox->delete();
        Session::flash('success', 'ServiceBox has been deleted');
    }
}
