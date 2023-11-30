<?php

namespace App\Services;

use App\Models\Admin;

class AdminLoginService
{
    public function validateData($request)
    {
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $data = [$fieldType => $request->email, 'password' => $request->password];

        $admin = Admin::where('email', $request->email)->orWhere('username', $request->email)->first();

        if ($admin) {
            if (!$admin->status) {
                return redirect()->route('admin.login')->with('error', 'Your account is currently disabled');
            }
        }

        $remember = $request->remember == 'on' ? true : false;

        return [$data, $remember];
    }
}
