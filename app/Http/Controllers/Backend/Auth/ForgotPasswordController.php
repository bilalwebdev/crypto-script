<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminForgotPasswordRequest;
use App\Models\Admin;
use App\Models\AdminPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Services\AdminForgotPasswordService;

class ForgotPasswordController extends Controller
{

    protected $forgotPassword;

    public function __construct(AdminForgotPasswordService $forgotPassword)
    {

        $this->forgotPassword = $forgotPassword;

        $this->middleware('admin.guest');
    }

    public function showLinkRequestForm()
    {
        $data['title'] = 'Account Recovery';

        AdminPasswordReset::truncate();

        return view('backend.auth.forgot-password')->with($data);
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    public function sendResetCodeEmail(AdminForgotPasswordRequest $request)
    {
        $isFired = $this->forgotPassword->forgot($request);

        if($isFired['type'] === 'error'){
            return back()->with('error', $isFired['message']);
        }

        return redirect()->route('admin.password.verify.code')->with('success', $isFired['message']);
    }

    public function verifyCodeForm(Request $request)
    {
        $data['title'] = __('Code Verify');

        return view('backend.auth.code_verify')->with($data);
    }


    public function verifyCode(AdminForgotPasswordRequest $request)
    {
        $code = session('code') == $request->code ? true : false;

        if ($code) {
            return redirect()->route('admin.password.reset.form', $request->code)->with('success', 'Now you can reset your Password');
        }

        return back()->with('error', 'Verification Code did not match');
    }
}
