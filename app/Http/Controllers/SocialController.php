<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;

use Socialite;
use Exception;
use Auth;

class SocialController extends Controller
{
    //

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
    
            // $user = Socialite::driver('facebook')->user();
            $user = Socialite::driver('facebook')->User()->SocialUser();
            // $isUser = SocialUser::where('fb_id', $user->id)->first();
            $isUser = User::SocialUser()->where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect()->route('about-us');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


    // google
    public function redirectToGoogle(){

        return Socialite::driver('google')->redirect();

    }
    public function handleGoogleCallback(){
        // try {
      
            $user = Socialite::driver('google')->user();
            $isUser = SocialUser::where('google_id', $user->id)->first();
       
            if($isUser){
       
            //     Auth::login($finduser);
      
                return redirect()->route('about-us');

            }
      
        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}