<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WhyUs;
use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Files;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;


use App\Models\Inbox;
class WhyController extends Controller
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
        return view('admin.why.index')
                    ->with('why', WhyUs::findOrFail(1))
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'WhyUs');
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
        $input = $request->all();

        if($request->hasFile('photo')){
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();
            
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/whyUs/thumbnails/'.$fileName, 50);
           
            $request->photo->storeAs('whyUs', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        WhyUs::create($input);
        Session::flash('success', 'Why-us Section has been published');
        
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
        $whyUs = whyUs::where('id', $id)->first();
        
        $input = $request->all();
        if($request->hasFile('photo')){
            
            if($oldFile = $whyUs->photo){
                \Storage::delete('/public/whyUs/'.$oldFile);
                \Storage::delete('/public/whyUs/thumbnails/'.$oldFile);
            }
            
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();

            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/whyUs/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('whyUs', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        $whyUs->update($input);
        Session::flash('success', 'Why-us section has successfully updated');
        return redirect()->back();
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
