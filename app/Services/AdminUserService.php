<?php

namespace App\Services;

use App\Models\AdminUser;
use App\Models\Configuration;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminUserService
{
    public function update($request)
    {
        $user = User::find($request->user);


        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'country' => 'required'
        ]);


        $data = [
            'country' => $request->country,
        ];


        // AdminUser::where('user_id', $user->id)->delete();

        // foreach ($request->admins as $key => $value) {
        //     AdminUser::create([
        //         'admin_id' => $value,
        //         'user_id' => $user->id
        //     ]);
        // }


        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $data;
        $user->password = $request->password;
        $user->status = $request->status == 'on' ? 1 : 0;
        $user->is_email_verified = $request->email_status == 'on' ? 1 : 0;
        $user->is_sms_verified = $request->sms_status == 'on' ? 1 : 0;
        $user->is_kyc_verified = $request->kyc_status == 'on' ? 1 : 0;

        $user->save();


        return ['type' => 'success', 'message' => 'Successfully Updated User Profile'];
    }

    public function create($request)
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'country' => 'required'
        ]);

        $data = [
            'country' => $request->country,
        ];

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $data,
            'phone' => $request->phone
        ]);
    }
    public function updateBalance($request)
    {
        $user = User::findOrFail($request->user_id);

        $general = Configuration::first();

        if ($request->type == 'add') {
            $user->balance =  $user->balance + $request->balance;
        } else {
            if ($user->balance < $request->balance) {
                return ['type' => 'error', 'message' => 'Insufficient balance'];
            }
            $user->balance =  $user->balance - $request->balance;
        }

        $user->save();

        $trx = strtoupper(Str::random());

        Transaction::create([
            'trx' => $trx,
            'user_id' => $user->id,
            'amount' => $request->balance,
            'charge' => 0,
            'details' => $request->type === 'add' ? 'Balance Added By Admin' : 'Balance Subtruct By Admin',
            'type' => $request->type === 'add' ? '+' : '-'
        ]);


        return ['type' => 'success', 'message' => 'Successfully ' . $request->type . ' balance'];
    }
}
