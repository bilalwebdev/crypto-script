<?php

namespace App\Http\Middleware;

use App\Helpers\Helper\Helper;
use App\Mail\EmailVerification;
use App\Models\Configuration;
use App\Models\Template;
use Closure;
use Illuminate\Support\Facades\Mail;

class isEmailVerified
{

    public function handle($request, Closure $next)
    {

        $general = Configuration::first();

        $user = auth()->user();


        if ($general->is_email_verification_on && !$user->is_email_verified) {

            $randomNumber = rand(0, 999999);

            $user->email_verification_code = $randomNumber;
            $user->save();

            $template = Template::where('name', 'verify_email')->where('status', 1)->first();

            if ($template) {
                Helper::fireMail([
                    'username' => $user->username,
                    'email' => $user->email,
                    'app_name' => Helper::config()->appname,
                    'code' => $randomNumber
                ], $template);
            }

            return redirect()->route('user.authentication.verify');
        }
        return $next($request);
    }
}
