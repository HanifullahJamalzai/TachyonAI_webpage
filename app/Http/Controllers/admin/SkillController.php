<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;


use App\Models\Inbox;
class SkillController extends Controller
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
        return view('admin.skill.index')
                    ->with('skill', Skill::findOrFail(1))
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Skill');
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
            'title'=> 'required|max:255',
            'subtitle'=> 'required|max:255'
        ]);

        $input = $request->all();
        if($request->hasFile('photo')){
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();

            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);

            $img->save('storage/skill/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('skill', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        Skill::create($input);
        Session::flash('success', 'Skill section has been Published Successfully');
        
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
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'subtitle'=> 'required|max:255'
        ]);

        $input = $request->all();
        if($request->hasFile('photo')){
            if($oldFile = $skill->photo){
                \Storage::delete('/public/skill/'.$oldFile);
                \Storage::delete('/public/skill/thumbnails/'.$oldFile);
            }
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();

            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);

            $img->save('storage/skill/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('skill', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        $skill->update($input);
        Session::flash('success', 'Skill section has been Published Successfully');
        
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
