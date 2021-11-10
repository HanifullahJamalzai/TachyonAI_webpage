<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TeamDetail;
use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;

use App\Http\Requests\TeamRequest;

use App\Models\Inbox;
class TeamDetailController extends Controller
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
        return view('admin.team.team')
                    ->with('members', TeamDetail::all())
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Team');
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
            'full_name' => 'required|max:50',
            'position' => 'required|max:50',
            'bio' => 'required|max:256',
            'photo' => 'required|max:100',
        ]);
        
        $request->merge(['slug' => Str::slug($request->full_name)]);
        $input = $request->all();

        if($request->hasFile('photo')){
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();
            
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/team/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('team', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        TeamDetail::create($input);
        Session::flash('success', 'Team member has been added successfully');
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
    public function update(TeamRequest $request, TeamDetail $teamdetail)
    {
            
        $request->merge(['slug' => Str::slug($request->full_name)]);
        $input = $request->all();

        if($request->hasFile('photo')){
            if($oldFile = $teamdetail->photo){
                \Storage::delete('/public/team/'.$oldFile);
                \Storage::delete('/public/team/thumbnails/'.$oldFile);
            }
            $fileName = rand(10, 10000).'_'.$request->photo->getClientOriginalName();
            
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/team/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('team', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        $teamdetail->update($input);
        Session::flash('success', 'Team member has been updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamDetail $teamdetail)
    {
        $teamdetail->delete();
        Session::flash('success', 'Team member has been deleted successfully');
        
    }
}
