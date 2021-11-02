<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construction()
    {
        //it is for webPage  
        $hero = Hero::all();

        // sharing is caring
        View::share('hero', $hero);

    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
