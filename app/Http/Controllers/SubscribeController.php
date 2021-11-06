<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Newsletter;
class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        try {
            if(Newsletter::isSubscribed($request->email))
            {
                Session::flash('subscribe_error', 'Email already exist');
            }
            else
            {
                Newsletter::subscribe($request->email);
                Session::flash('subscribe', 'You have successfully subscribed');
            }
        } catch (\Exception $e) {
            session::flash('subscribe_error', $e->getMessage()); 
            return redirect()->back();
        }

        return redirect()->back();

    }
    
    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        Newsletter::unsubscribe($request->email);

        Session::flash('subscribe', 'You have successfully unsubscribed');
        return redirect()->back();
    }
}
