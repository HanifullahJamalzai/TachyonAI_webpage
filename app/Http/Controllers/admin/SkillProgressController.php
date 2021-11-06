<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Str;
use App\Models\SkillProgress;
class SkillProgressController extends Controller
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
        return view('admin.skill.progress')
                    ->with('skills', SkillProgress::orderBy('created_at', 'asc')->get())
                    ->with('page', 'Skill-Progress');
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
            'progressbar_title' => 'required|max:100',
            'percentage' => 'required|integer|between:1,100'
        ]);
                        //  'required|numeric|between:1,2',
                        //  'required|digits_between:1,2',
        $request->merge(['slug' => Str::slug($request->progressbar_title)]);
        $input = $request->all();
        SkillProgress::create($input);
        Session::flash('success', 'Skill Progressbar has successfully added to the list');
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
        $skill = SkillProgress::where('slug', $id)->first();
        // dd($skill->progressbar_title);
        // exit;
        return view('admin.skill.progress', compact('skill'))
                    ->with('skills', SkillProgress::all())
                    ->with('page', 'Skill-Progress');
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
        $skillProgress = SkillProgress::where('slug', $id)->first();

        $request->validate([
            'progressbar_title' => 'required|max:100',
            'percentage' => 'required|integer|between:1,100'
        ]);
                        //  'required|numeric|between:1,2',
                        //  'required|digits_between:1,2',

        $request->merge(['slug' => Str::slug($request->progressbar_title)]);
        $input = $request->all();
        $skillProgress->update($input);

        Session::flash('success', 'Skill Progressbar has successfully Updated');
        return redirect()->route('skillprogress.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillProgress $skillprogress)
    {
        $skillprogress->delete();
        Session::flash('success', 'Skill Progressbar has been successfully deleted');

    }
}
