<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Support\Str;

class PaymentService
{
    public function payNow($request)
    {
        $gateway = Gateway::where('status', 1)->find($request->id);

        if(!$gateway){
            return ['type' => 'error' , 'message' => 'Gateway Not Found'];
        }

        $trx = Str::upper(Str::random(16));

        $final_amount = ($request->amount * $gateway->rate) + $gateway->charge;

        if (isset($request->type) && $request->type == 'deposit') {

            $deposit = Deposit::create([
                'gateway_id' => $gateway->id,
                'user_id' => auth()->id(),
                'trx' => $trx,
                'amount' => $request->amount,
                'rate' => $gateway->rate,
                'charge' => $gateway->charge,
                'total' => $final_amount,
                'status' => 0,
                'type' => 1,
            ]);

            session()->put('trx', $trx);
            session()->put('type', 'deposit');


            return ['type' => 'deposit' , 'message' => route('user.gateway.details', $gateway->id)];
        }

        $plan = Plan::find($request->plan_id);

        if(!$plan){
            return ['type' => 'error' , 'message' => 'Plan Not Found'];
        }

        $plan_expired_at = $plan->plan_type === 'limited' ? now()->addDays($plan->duration) : now()->addYear(50);

        $payment = Payment::create([
            'plan_id' => $plan->id,
            'gateway_id' => $gateway->id,
            'user_id' => auth()->id(),
            'trx' => $trx,
            'amount' => $request->amount,
            'rate' => $gateway->rate,
            'charge' => $gateway->charge,
            'total' => $final_amount,
            'status' => 0,
            'type' => $gateway->type,
            'plan_expired_at' => $plan_expired_at

        ]);

        session()->put('trx', $trx);
        session()->put('type', 'payment');


        return ['type' => 'payment' , 'message' => route('user.gateway.details', $gateway->id)];
    }

    public function details($id)
    {
        $data['gateway'] = Gateway::where('status', 1)->where('id', $id)->first();

        if(!$data['gateway']){
            return ['type' => 'error', 'message' => 'No Gateway Found'];
        }

        $data['title'] = $data['gateway']->name . ' Payment Details';

        if(!$data['gateway']){
            return ['type' => 'error', 'message' => 'No Gateway Found'];
        }

        if (session('type') == 'deposit') {

            $data['deposit'] = Deposit::where('trx', session('trx'))->first();

        } else {

            $data['deposit'] = Payment::where('trx', session('trx'))->first();
        }

        if(!$data['deposit']){
            return ['type' => 'error', 'message' => 'Not Found'];
        }

      

        if ($data['gateway']->name == 'vougepay') {
            $vouguePayParams["marchant_id"] = $data['gateway']->parameter->vouguepay_merchant_id;
            $vouguePayParams["redirect_url"] = route("user.payment.success", 'vougepay');
            $vouguePayParams["currency"] = $data['gateway']->parameter->gateway_currency;
            $vouguePayParams["merchant_ref"] = $data['deposit']->trx;
            $vouguePayParams["memo"] = "Payment";
            $vouguePayParams["store_id"] = $data['deposit']->user_id;
            $vouguePayParams["loadText"] = $data['deposit']->trx;
            $vouguePayParams["amount"] = $data['deposit']->total;
            $vouguePayParams = json_decode(json_encode($vouguePayParams));

            $data['vouguePayParams'] = $vouguePayParams;
        }

        if ($data['gateway']->type == 0) {
            return ['type'=> '','view' => Helper::theme().'user.gateway.offline', 'data' => $data];
        }


        return ['type'=> '', 'view' => Helper::theme().'user.gateway.online', 'data' => $data];

    }
}
