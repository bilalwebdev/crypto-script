<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserRegistration
{
    public function register($request)
    {
        $general = Configuration::first();

        $signupBonus = $general->signup_bonus;

        $referid = 0;

        if ($request->reffered_by) {
            $referUser = User::where('username', $request->reffered_by)->first();

            $referid = $referUser->id;

            if (!$referUser) {
                return ['type' => 'error', 'message' => 'No User Found Assocciated with this reffer Name'];
            }
        }

        event(new Registered($user = $this->create($request, $signupBonus, $referid)));





        Auth::login($user);

        if ($request->reffered_by) {

            Helper::referMoney($user->id, $referUser, 'interest', 0);
        }


        return ['type' => 'success', 'message' => 'Successfully Registered'];
    }


    public function create($request, $signupBonus, $referid)
    {

        // write here register MT5 account

        return User::create([
            'balance' => $signupBonus,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 1,
            'password' => bcrypt($request->password),
            'ref_id' => $referid ?? ''
        ]);

       



    }
}
