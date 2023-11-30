<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Mail\SendForgotpasswordMail;
use App\Models\Admin;
use App\Models\AdminPasswordReset;
use App\Models\Template;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class AdminForgotPasswordService
{
    public function forgot($request)
    {

        $user = Admin::where('email', $request->email)->first();

        if (!$user) {
            return array('message' => 'Email Not Available', 'type' => 'error');
        }

        if ($freq_req = Cache::get($user->email)) {
            return array('message' => $freq_req, 'type' => 'error');
        }

        $code = Helper::verificationCode(6);

        AdminPasswordReset::create([
            'email' => $user->email,
            'token' => $code,
            'status' => 0
        ]);

        session()->put('code', $code);

        Cache::add($user->email, 'Please wait 60 sec for another request.', 60);

        $template = Template::where('name', 'password_reset')->where('status', 1)->first();

        if ($template) {
            Helper::fireMail([
                'username' => $user->username,
                'email' => $user->email,
                'app_name' => Helper::config()->appname,
                'code' => $code
            ], $template);
        }

       

        return ['message' => 'Verification Code send to your mail', 'type' => 'success'];
    }


    public function sendAgain()
    {
        $resetToken = AdminPasswordReset::where('token', session('code'))->where('status', 0)->first();

        $code = Helper::verificationCode(6);

        $user = Admin::where('email', $resetToken->email)->first();


        // if another request within 1 min
        if ($freq_req = Cache::get($user->email)) {
            return array('message' => $freq_req, 'type' => 'error');
        }


        $resetToken->token = $code;

        $resetToken->save();



        session()->put('code', $code);

        session()->put('timer', 60);

        return ['message' => 'Send Code Again', 'type' => 'success'];
    }

    public function reset($request)
    {
        $reset = AdminPasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();

        $user = Admin::where('email', $reset->email)->first();

        if ($reset->status == 1) {
            return array('message' => 'Invalid code', 'type' => 'error');
        }

        $user->password = bcrypt($request->password);

        $user->save();

        $reset->status = 1;

        $reset->save();

        return array('message' => 'successfully change your password', 'type' => 'success');
    }
}
