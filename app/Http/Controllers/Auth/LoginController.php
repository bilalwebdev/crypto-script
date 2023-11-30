<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserLogin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $login;

    public function __construct(UserLogin $login)
    {
        $this->login = $login;
    }
    public function index()
    {
        $data['title'] = 'Login Page';

        $data['content'] = Helper::builder('auth');

        return view(Helper::theme() . 'auth.login')->with($data);
    }

    public function login(UserLoginRequest $request)
    {

        $isSuccess = $this->login->login($request);

        if ($isSuccess['type'] == 'error') {
            return redirect()->route('user.login')->with('error', $isSuccess['message']);
        }

        return redirect()->route('user.dashboard')->with('success', $isSuccess['message']);
    }

    public function signOut()
    {
        Auth::logout();

        return Redirect()->route('user.login');
    }
}
