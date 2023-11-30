<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\Deposit;
use App\Models\Payment;
use CoinpaymentsAPI as GlobalCoinpaymentsAPI;
use Illuminate\Http\Request;

class CoinpaymentsService
{

    public static function process($request, $gateway, $totalAmount, $deposit)
    {
        $general = Configuration::first();
        $amount = $totalAmount; // Amount in dollars
        $currency = 'USD'; // Currency
        $referenceCode = $deposit->trx; // Unique reference code

        $api = new GlobalCoinpaymentsAPI($gateway->parameter->private_key, $gateway->parameter->public_key, '');
        $req = array(
            'amount' => $amount,
            'currency1' => $gateway->parameter->gateway_currency,
            'currency2' => $currency,
            'item_name' => 'Payment for Order #' . $referenceCode,
            'invoice' => $referenceCode,
            'buyer_email' => $deposit->user->email,
            'ipn_url' => url('/coinpayments/ipn'), // IPN URL to receive payment notification
            'success_url' => url('/payment/success'), // Redirect URL after successful payment
            'cancel_url' => url('/payment/cancel'), // Redirect URL after cancelled payment
        );
        $transaction = $api->CreateCustomTransaction($req);

        if (isset($transaction['error'])) {
            return ['type' => 'error', 'message' => $transaction['error']];
        }

        // Redirect to CoinPayments payment page
        return $transaction['result']['status_url'];
    }

    public static function success(Request $request)
    {
        if (session('type') == 'deposit') {
            $payment = Deposit::where('trx', session('trx'))->first();
        } else {
            $payment = Payment::where('trx', session('trx'))->first();
        }

        Helper::paymentSuccess($payment, $payment->charge, session('trx'));
    }
}
