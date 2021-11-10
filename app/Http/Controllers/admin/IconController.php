<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inbox;
class IconController extends Controller
{

    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index(){

        return view('admin.icon.index')
                    ->with('msg_notification', Inbox::where('status', 0)->count())
                    ->with('page', 'Icon');
    }
}
