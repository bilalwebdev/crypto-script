<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use App\Services\EmailVerification;


class EmailVerificationController extends Controller
{
    protected $verify;

    public function __construct(EmailVerification $verifcation)
    {
        $this->verify = $verifcation;
    }

    public function emailVerify()
    {
        $data['title'] = "Email Verify";

        return view(Helper::theme() . 'auth.email_sms_verify');
    }

    public function emailVerifyConfirm(EmailVerificationRequest $request)
    {
        $isSucces = $this->verify->verify($request);

        if ($isSucces['type'] === 'success') {
            return  redirect()->route('user.dashboard')->with('success', $isSucces['message']);
        }

        return  redirect()->back()->with('error', $isSucces['message']);
    }
}
