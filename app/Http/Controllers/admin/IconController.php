<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IconController extends Controller
{

    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index(){

        return view('admin.icon.index')
                    ->with('page', 'Icon');
    }
}
