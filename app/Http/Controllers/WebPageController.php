<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class WebPageController extends Controller
{
    $hero = Hero::findOrFail(1);
    dd($hero->title);
    exit;
    public function index()
    {
        return view('welcome')
                    ->with('hero', Hero::all())
                    ->with('Page', 'TachyonAI');
    }
}
