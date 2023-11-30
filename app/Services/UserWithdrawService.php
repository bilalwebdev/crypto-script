<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use App\Notifications\WithdrawNotification;
use Nette\Utils\Random;

class UserWithdrawService{
    
    public function makeWithdraw($request)
    {

       
        $general = Configuration::first();

        $withdraw = Withdraw::where('user_id', auth()->id())->whereDate('created_at', now())->count();

        if ($general->withdraw_limit <= $withdraw) {
            return ['type' => 'error', 'message' => 'Per day withdrawal limit exceed'];
        }

        $withdraw = WithdrawGateway::find($request->method);

        if(!$withdraw){
            return ['type' => 'error', 'message' => 'Method Not Found'];
        }

        if (auth()->user()->balance < $request->amount) {
            return ['type' => 'error', 'message' => 'Insuficient Balance'];
        }


        if (($request->amount < $withdraw->min_withdraw_amount) || ($request->amount > $withdraw->max_withdraw_amount)) {
            return ['type' => 'error', 'message' => 'Please follow the withdraw limits'];
        }

        if ($withdraw->type == 'percent') {

            $total = $request->amount - ($withdraw->charge * $request->amount) / 100;

            $charge = ($withdraw->charge * $request->amount) / 100;
        } else {
            $total = $request->amount - $withdraw->charge;

            $charge = $withdraw->charge;
        }
        


        if (number_format($total, 2) != number_format($request->final_amo, 2)) {
            return ['type' => 'error', 'message' => 'Invalid Amount'];
        }

        auth()->user()->balance = auth()->user()->balance - $request->amount;
        auth()->user()->save();


        $data = [
            'email' => $request->email,
            'account_information' => $request->account_information,
            'note' => $request->note
        ];


        $withdraw = Withdraw::create([
            'user_id' => auth()->id(),
            'withdraw_method_id' => $request->method,
            'trx' => strtoupper(Random::generate(15)),
            'proof' => $data,
            'withdraw_charge' => $charge,
            'withdraw_amount' => $request->amount,
            'total' => $request->final_amo,
            'status' => 0
        ]);

        Transaction::create([
            'trx' => $withdraw->trx,
            'amount' => $request->amount,
            'details' => 'Withdraw Balance',
            'charge' => $charge,
            'type' => '-',
            'user_id' => auth()->id()
        ]);

        $admin = Admin::where('type', 'super')->first();

        $admin->notify(new WithdrawNotification($withdraw));

        return ['type' => 'success', 'message' => 'Withdraw Successfully done'];
    }
}