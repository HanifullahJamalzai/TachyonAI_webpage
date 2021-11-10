<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FaqAccordion;
use Session;
use Str;
use App\Http\Requests\FaqRequest;

use App\Models\Inbox;
class FaqAccordionController extends Controller
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
        return view('admin.faq.faq')
                    ->with('faqs', FaqAccordion::all())
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'FAQ');
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
    public function store(FaqRequest $request)
    {
        $request->merge(['slug' => Str::slug($request->question)]);

        FaqAccordion::create($request->all());
        Session::flash('success', 'FAQ Accordion has been added successfully');
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
    public function update(FaqRequest $request, FaqAccordion $faqaccordion)
    {
    
        $request->merge(['slug' => Str::slug($request->question)]);

        $faqaccordion->update($request->all());
        Session::flash('success', 'FAQ Accordion has been updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqAccordion $faqaccordion)
    {
        $faqaccordion->delete();
        Session::flash('success', 'FAQ Accordion has been deleted Successfully');
    }
}
