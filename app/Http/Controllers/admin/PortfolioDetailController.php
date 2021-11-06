<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PortfolioDetail;

use Session;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;

class PortfolioDetailController extends Controller
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
        return view('admin.portfolio.portfolio')
                    ->with('portfolios', PortfolioDetail::all())
                    ->with('page', 'Portfolio');
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
            'type' => 'required|max:100',
            'photo' => 'required|max:100',
        ]);
        
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();

        if($request->hasFile('photo')){
            $fileName = $request->photo->getClientOriginalName();
            
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/portfolio/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('portfolio', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        PortfolioDetail::create($input);
        Session::flash('success', 'Portfolio has been added successfully');
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
    public function update(Request $request, PortfolioDetail $portfoliodetail)
    {
        $request->validate([
            'title' => 'required|max:100',
            'type' => 'required|max:100',
            'photo' => 'required|max:100',
        ]);
        
        $request->merge(['slug' => Str::slug($request->title)]);
        $input = $request->all();

        if($request->hasFile('photo')){
            if($oldFile = $portfoliodetail->photo){
                \Storage::delete('/public/portfolio/'.$oldFile);
                \Storage::delete('/public/portfolio/thumbnails/'.$oldFile);
            }
            $fileName = $request->photo->getClientOriginalName();
            
            $image = $request->file('photo');
            $img = ImageManagerStatic::make($image);
            $img->resize(200,200);
            $img->save('storage/portfolio/thumbnails/'.$fileName, 50);

            $request->photo->storeAs('portfolio', $fileName, 'public');
            $input['photo'] = $fileName;
        }
        $portfoliodetail->update($input);
        Session::flash('success', 'Portfolio has been Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioDetail $portfoliodetail)
    {
        $portfoliodetail->delete();
        Session::flash('success', 'Portfolio has been deleted successfully');
        
    }
}
