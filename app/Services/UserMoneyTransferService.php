<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\MoneyTransfer;
use App\Models\PlanSubscription;
use App\Models\Template;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class UserMoneyTransferService
{
    public function transferMoney($request)
    {

     
        $general = Configuration::first();

        $range = range($general->transfer_min_amount, $general->transfer_max_amount);

        if (!in_array($request->amount, $range)) {

            return ['type' => 'error', 'message' => 'Please follow transfer Limit'];
        }

        $transferCount = MoneyTransfer::where('sender_id', auth()->id())->whereDate('created_at', now())->count();

        if ($transferCount >= $general->transfer_limit) {
            return ['type' => 'error', 'message' => 'Transfer Limit exceeded for today'];
        }

        $payment = PlanSubscription::where('user_id', auth()->id())->where('is_current', 1)->count();

        if ($payment <= 0) {
            return ['type' => 'error', 'message' => 'You have to invest on a plan to use Signup Balance'];
        }

        $receiver = User::where('email', $request->email)->first();

        if (auth()->user()->email == $request->email) {

            return ['type' => 'error', 'message' => 'You can not send money to your account'];
        }

        if (!$receiver) {

            return ['type' => 'error', 'message' => 'No User Found With this email'];

        }

        $commison = $general->transfer_type === 'percent' ? ($request->amount * $general->transfer_charge) / 100 :  $general->transfer_charge;

        $totalSendAmount = $commison + $request->amount;


        if (auth()->user()->balance < $totalSendAmount) {

            return ['type' => 'error', 'message' => 'Insufficient Balance'];
        }

        $user = auth()->user();

        $user->balance = $user->balance - $totalSendAmount;

        $user->save();


        $trx = strtoupper(Str::random());


        MoneyTransfer::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'trx' => $trx,
            'details' => 'Money Transfer',
            'amount' => $request->amount,
            'charge' => $commison
        ]);


        Transaction::create([
            'trx' => $trx,
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'details' => 'Transfer Money',
            'charge' => $commison,
            'type' => '-'
        ]);

        $receiver->balance = $receiver->balance + $request->amount;

        $receiver->save();

        $trx = strtoupper(Str::random());

        Transaction::create([
            'trx' => $trx,
            'amount' => $request->amount,
            'details' => 'Receive Money',
            'charge' => 0,
            'type' => '+',
            'user_id' => $receiver->id
        ]);


        $template = Template::where('name','send_money')->where('status',1)->first();

        if($template){
            Helper::fireMail([
                'app_name' => $general->appname,
                'email' => $user->email,
                'username' => $user->username,
                'receiver' => $receiver->username,
                'amount' => $request->amount,
                'trx' => $trx
            ], $template);
        }



        $template2 = Template::where('name','receive_money')->where('status',1)->first();

        if($template2){
            Helper::fireMail([
                'app_name' => $general->appname,
                'email' => $receiver->email,
                'username' => $receiver->username,
                'sender' => $user->username,
                'amount' => $request->amount,
                'trx' => $trx
            ], $template2);
        }


        return ['type' => 'success', 'message' => 'Money Transfer Successfull'];
    }
}
