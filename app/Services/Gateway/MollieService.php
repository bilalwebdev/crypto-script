<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;
use Mollie\Laravel\Facades\Mollie as FacadesMollie;

class MollieService
{
    public static function process($request, $gateway, $amount, $deposit)
    {

        FacadesMollie::api()->setApiKey($gateway->parameter->mollie_key);

        try {
            $payment = FacadesMollie::api()->payments->create([
                "amount" => [
                    "currency" => $gateway->parameter->gateway_currency,
                    "value" => '' . sprintf('%0.2f', round($amount, 2)) . '', // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => "Payment For Purhcasing Plan",
                "redirectUrl" => route('user.payment.success', $gateway->name),
                'metadata' => [
                    "order_id" => $deposit->trx,
                ],

            ]);
        } catch (\Throwable $th) {
            return ['type' => 'error', 'message' => 'Something went wrong ! Check your api credentials'];
        }

        $payment = FacadesMollie::api()->payments()->get($payment->id);

        session()->put('payment_id', $payment->id);
        session()->put('trx', $deposit->trx);

        return ['redirect_url' => $payment->getCheckoutUrl()];
    }


    public static function success()
    {
        if (session('type') == 'deposit') {
            $deposit = Deposit::where('trx', session('trx'))->first();
        } else {
            $deposit = Payment::where('trx', session('trx'))->first();
        }

        FacadesMollie::api()->setApiKey($deposit->gateway->gateway_parameters->mollie_key);

        $payment = FacadesMollie::api()->payments()->get(session('payment_id'));

        if ($payment->isPaid()) {

            Helper::paymentSuccess($deposit, $deposit->charge, $deposit->transaction_id);

            return ['type' => 'success' ,'message' => 'Payment Successfull'];
        }

        return ['type' => 'error' ,'message' => 'Something Went Wrong'];
    }
}
