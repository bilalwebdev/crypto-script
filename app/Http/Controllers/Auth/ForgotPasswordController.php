<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\GeneralSetting;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class ForgotPasswordController extends Controller
{

    public function index()
    {
        $data['title'] = 'Forgot Password';

        return view(Helper::theme().'auth.email')->with($data);
    }

    public function sendVerification(Request $request)
    {
        $general = Configuration::first();
        
        $request->validate([
            'email' => 'required|email',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha== 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

         
         $user = User::where('email', $request->email)->first();
         


        if (!$user) {
            return back()->with('error', 'Please Provide a valid Email');
        }

        $code = random_int(100000, 999999);

        $user->email_verification_code = $code;

        $user->save();

        $template = Template::where('name', 'password_reset')->where('status', 1)->first();

        if ($template) {
            Helper::fireMail([
                'username' => $user->username,
                'email' => $user->email,
                'app_name' => Helper::config()->appname,
                'code' => $code
            ], $template);
        }

        

        session()->put('email',$user->email);

        return redirect()->route('user.auth.verify')->with('success', 'Send verification code to your email');
    }

    public function verify()
    {
        $email = session('email');

        $title = 'Verify Code';

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('user.forgot.password');
        }

        return view(Helper::theme().'auth.verify', compact('title', 'email'));
    }

    public function verifyCode(Request $request)
    {
        $general = Configuration::first();
        $request->validate([
            'code' => 'required',
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha== 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]);

        $user = User::where('email', $request->email)->first();


        $token = $user->email_verification_code;

        if ($user->email_verification_code != $request->code) {

            $user->email_verification_code = null;

            $user->save();

            return back()->with('error','Invalid Code');
        }

        $user->email_verification_code = null;

        $user->save();

        session()->put('identification', [
            "token" => $token,
            "email" => $user->email
        ]);

        return redirect()->route('user.reset.password');
    }

    public function reset()
    {
        $session = session('identification');

        if (!$session) {

            return redirect()->route('user.login');
        }

        $title = 'Reset Password';

        return view(Helper::theme().'auth.reset', compact('title', 'session'));
    }

    public function resetPassword(Request $request)
    {
        $general = Configuration::first();

        $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required|confirmed',
            'g-recaptcha-response'=>Rule::requiredIf($general->allow_recaptcha == 1)
        ],[
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ]
        );


        $user = User::where('email', $request->email)->first();

        $user->password = bcrypt($request->password);

        $user->save();


        return redirect()->route('user.login')->with('success', 'Successfully Reset Your Password');
    }


     public function verifyAuth()
    {
        if(auth()->user()->ev && auth()->user()->sv){
            return redirect()->route('user.dashboard');
        }

        $title = 'Verify Account';
        return view(Helper::theme().'auth.email_sms_verify',compact('title'));
    }

    public function verifyEmailAuth(Request $request)
    {
        $user = auth()->user();

        $request->validate(['code' => 'required']);

        if($user->email_verification_code != $request->code){
            return redirect()->back()->with('error','Invalid Verification Code');
        }

        $user->email_verification_code = null;

        $user->is_email_verified = 1 ;

        $user->save();

        return redirect()->route('user.dashboard');
    }


    public function verifySmsAuth(Request $request)
    {
        $user = auth()->user();

        $request->validate(['code' => 'required']);

        if($user->sms_verification_code != $request->code){
            return redirect()->back()->with('error','Invalid Verification Code');
        }

        $user->sms_verification_code = null;

        $user->sv = 1 ;

        $user->save();

        return redirect()->route('user.dashboard');
    }

}
