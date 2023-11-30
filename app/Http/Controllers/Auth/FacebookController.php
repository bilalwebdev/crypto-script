<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('email', $user->email)->first();
        
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->route('user.dashboard');
         
            }else{
                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456'),
                    'status' => 1
                ]);

                Auth::login($newUser);
        
                return redirect()->route('user.dashboard');
            }
        
        } catch (Exception $e) {
            return redirect()->route('user.login')->with('error','Something Went Wrong');
        }
    }
}
