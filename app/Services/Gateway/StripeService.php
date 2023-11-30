<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use Stripe;

class StripeService
{
    public static function process($request, $stripe, $payingAmount, $deposit)
    {
        Stripe\Stripe::setApiKey($stripe->parameter->stripe_client_secret);

        $payment = Stripe\Charge::create([
            "amount" => $payingAmount * 100,
            "currency" => $stripe->parameter->gateway_currency,
            "source" => $request->stripeToken,
            "description" => "{$deposit->transaction_id}"
        ]);

        $responseData = $payment->jsonSerialize();

        $transaction = $responseData['id'];

        $bal = \Stripe\BalanceTransaction::retrieve($responseData['balance_transaction']);

        $balJson = $bal->jsonSerialize();

        $fee_amount = number_format(($balJson['fee'] / 100), 4) /  $stripe->rate;

        if ($payment->status == 'succeeded') {

            Helper::paymentSuccess($deposit, $fee_amount, $transaction);

            return ['type' => 'success', 'message' => 'Payment Successfully Done'];
        }

        return ['type' => 'error', 'message' => 'Something Goes Wrong'];
    }
}
