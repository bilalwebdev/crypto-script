<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\Deposit;
use App\Models\Payment;
use Illuminate\Http\Request;

class MercadopagoService
{
    public static function process($request, $gateway, $amount, $deposit)
    {
        $general = Configuration::first();

        $sandbox = false;

        $url = "https://api.mercadopago.com/checkout/preferences?access_token=" . $gateway->parameter->access_token;
        $headers = [
            "Content-Type: application/json",
        ];
        $postParam = [
            'items' => [
                [
                    'id' => $deposit->transaction_id,
                    'title' => number_format($amount, 2) . ' ' . $gateway->parameter->gateway_currency,
                    'description' => "Plan Purchase",
                    'installment' => 1,
                    'quantity' => 1,
                    'currency_id' => $gateway->parameter->gateway_currency,
                    'unit_price' => round($amount, 2)
                ]
            ],
            'payer' => [
                'email' => $deposit->user->email ?? '',
            ],
            'back_urls' => [
                'success' => route('user.dashboard'),
                'pending' => '',
                'failure' => route('user.dashboard'),
            ],
            'notification_url' => route('user.payment.success', $gateway->name),
            'auto_return' => 'approved',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postParam));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result);

        $send['preference'] = $preference->id ?? '';

        if (isset($response->auto_return) && $response->auto_return == 'approved') {
            if ($sandbox) {
                return ['type' => 'success', 'message' => $response->sandbox_init_point];
            } else {
                return ['type' => 'success', 'message' => $response->init_point];
            }
        } else {
            return ['type' => 'error', 'message' => 'Invalid Request'];
        }
    }

    public static function success(Request $request)
    {


        if (session('type') == 'deposit') {
            $deposit = Deposit::where('trx', session('trx'))->first();
        } else {
            $deposit = Payment::where('trx', session('trx'))->first();
        }


        $url = "https://api.mercadopago.com/v1/payments/" . $request['data']['id'] . "?access_token=" . $deposit->gateway->parameter->access_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $paymentData = json_decode($result);

        if (isset($paymentData->status) && $paymentData->status == 'approved') {
            Helper::paymentSuccess($deposit, 0, $deposit->trx);

            return ['type' => 'success' , 'message' =>'Payment Succesfull'];
        }
    }
}
