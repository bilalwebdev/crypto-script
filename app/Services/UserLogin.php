<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

class UserLogin
{
    public function login($request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return ['type' => 'error', 'message' => 'No user found associated with this email'];
        }

        if (Auth::attempt($request->except('g-recaptcha-response', '_token'))) {

            $ip = request()->ip();
            $currentUserInfo = Location::get($ip);

            $browser = new Browser();
            $os = new Os();

            UserLog::create([
                'user_id' => auth()->id(),
                'browser' => $browser->getName(),
                'system' => $os->getName(),
                'country' => $currentUserInfo->countryName ?? '',
                'ip' => $currentUserInfo->ip ?? '',
            ]);

            return ['type'=> 'success', 'message'=>'Successfully logged in'];
        }

        return ['type' => 'error', 'message' => 'Invalid credentials'];

    }
}
