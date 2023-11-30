<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailVerification
{
    public function verify($request)
    {

        $user = User::find(session('user'));

        if (!$user) {
            return ['type' => 'error', 'message' => 'User Not Found'];
        }

        if ($request->code == $user->verification_code) {
            $user->verification_code = null;
            $user->email_verified_at = now();
            $user->status = 1;

            $user->last_login = now();
            $user->save();

            Auth::login($user);

            return ['type' => 'success', 'message' => 'Successfully verify your account'];
        }

        return ['type' => 'success', 'message' => 'Verification Code not Matched'];
    }
}
