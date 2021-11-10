<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;

use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;

class HeroController extends Controller
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
        return view('admin.hero.index')
                    ->with('hero', Hero::findOrFail(1))
                    ->with('page', 'Hero');
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
            'title' => 'required|max:100',
            'subtitle' => 'required|max:256'
        ]);
        $input = $request->all();

        if($request->hasFile('image')){
            
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();
           
            $image = $request->file('image');
            $img = ImageManagerStatic::make($image);
            $img->resize(200, 200);
            $img->save('storage/hero/thumbnails/'.$fileName, 50);

            $request->image->storeAs('hero', $fileName, 'public');            
            $input['image'] = $fileName;
        }
        Hero::create($input);
        Session::flash('success', 'Hero section has successfully added');
        
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
    public function update(Request $request, Hero $hero)
    {
    
        $request->validate([
            'title' => 'required|max:256',
            'subtitle' => 'required|max:256'
        ]);
        $input = $request->all();
        if($request->hasFile('photo')){
            if($oldFile = $hero->photo){
                \Storage::delete('/public/hero/'.$oldFile);
                \Storage::delete('/public/hero/thumbnails/'.$oldFile);
            }
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200, 200);
            $img->save('storage/hero/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('hero', $fileName, 'public');            
            $input['photo'] = $fileName;
        }
        // dd($input);
        // exit;
        $hero->update($input);
        Session::flash('success', 'Hero section has successfully updated');
        
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
