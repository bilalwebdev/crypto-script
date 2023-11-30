<?php

namespace App\Services;

use App\Models\Configuration;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserService
{
    public function update($request)
    {
        $user = User::find($request->user);

        $data = [
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'state' => $request->state,
        ];

        $user->phone = $request->phone;
        $user->address = $data;
        $user->status = $request->status == 'on' ? 1 : 0;
        $user->is_email_verified = $request->email_status == 'on' ? 1 : 0;
        $user->is_sms_verified = $request->sms_status == 'on' ? 1 : 0;
        $user->is_kyc_verified = $request->kyc_status == 'on' ? 1 : 0;

        $user->save();


        return ['type' => 'success', 'message' => 'Successfully Updated User Profile'];
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
