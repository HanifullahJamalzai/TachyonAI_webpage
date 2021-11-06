<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WhyUsAccordion;
use Session;
use Str;

class WhyUsAccordionController extends Controller
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
        return view('admin.why.accordion')
                    ->with('accordions', WhyUsAccordion::all())
                    ->with('page', 'WhyUsAccordion');
        
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
            'title' => 'required|max:200',
            'description' => 'required'
        ]);

        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();

        WhyUsAccordion::create($input);

        Session::flash('success', 'Accordion has been added successfully');
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
    public function update(Request $request, WhyUsAccordion $whyusaccordion)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required'
        ]);

        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();
        $whyusaccordion->update($input);
        Session::flash('success', 'Why-us-accordion has been successfully updated');
        return redirect()->route('whyusaccordion.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhyUsAccordion $whyusaccordion)
    {
        $whyusaccordion->delete();
        Session::flash('success', 'Why-us-accordion has been successfully deleted');
    }
}
