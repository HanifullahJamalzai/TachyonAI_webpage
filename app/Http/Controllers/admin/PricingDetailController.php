<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Str;
use App\Http\Requests\PricingRequest;
use Session;
use App\Models\PricingDetail;
class PricingDetailController extends Controller
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
        return view('admin.pricing.pricing')
                    ->with('plans', PricingDetail::all())
                    ->with('page', 'Pricing');
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
    public function store(PricingRequest $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();
        PricingDetail::create($input);
        Session::flash('success', 'Pricing plan has been added successfully');
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
    public function update(PricingRequest $request, PricingDetail $pricingdetail)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();
        $pricingdetail->update($input);
        Session::flash('success', 'Pricing plan has been Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PricingDetail $pricingdetail)
    {
        $pricingdetail->delete();
        Session::flash('success', 'Pricing plan has been deleted successfully');
    }
}
