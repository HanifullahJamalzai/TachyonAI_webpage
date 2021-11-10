<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;


use App\Models\Inbox;
class ClientController extends Controller
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
        return view('admin.client.index')
                    ->with('clients', Client::all())
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Client');
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
            'name' => 'required|max:100',
            'logo' => 'required' 
        ]);
        
        $request->merge(['slug' => Str::slug($request->name)]);
        $input = $request->all();
        
        if($request->hasFile('logo')){
            $fileName = rand(10, 10000).'_'.$request->logo->getClientOriginalName();
            
            $image = $request->file('logo');
            $img = ImageManagerStatic::make($image);
            $img->resize(50,50);
            $img->save('storage/client/thumbnails/'.$fileName, 50);

            $request->logo->storeAs('client', $fileName, 'public');
            $input['logo'] = $fileName;
        }
        Client::create($input);
        Session::flash('success', 'Client has been added successfully');

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
    public function edit(Client $client)
    {   
        return view('admin.client.index')
                    ->with('clients', Client::all())
                    ->with('client', $client)
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Client');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|max:100',
            // 'logo' => 'required'
        ]);

        $request->merge(['slug' => Str::slug($request->name)]);
        $input = $request->all();
        

        if($request->hasFile('logo')){
            if($oldfile = $client->logo){
                \Storage::delete('/public/client/'.$oldfile);
                \Storage::delete('/public/client/thumbnails/'.$oldfile);
            }
            $fileName = rand(10, 10000).'_'.$request->logo->getClientOriginalName();

            $image = $request->file('logo');
            $img = ImageManagerStatic::make($image);
            $img->resize(50,50);

            $img->save('storage/client/thumbnails/'.$fileName, 50);

            $request->logo->storeAs('client', $fileName, 'public');
            $input['logo'] = $fileName;
        }
        $client->update($input);
        Session::flash('success', 'Client has been updated successfully');
        
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        session::flash('success', 'Client has been deleted Successfully');
    }
}
