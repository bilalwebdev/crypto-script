<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;
use Illuminate\Http\Request;
use Victorybiz\LaravelCryptoPaymentGateway\LaravelCryptoPaymentGateway;



class Gourl
{
    public static function process($request, $gateway, $amount, $deposit)
    {

        $payment_url = LaravelCryptoPaymentGateway::startPaymentSession([
            'amountUSD' => $deposit->amount,
            'orderID' => $deposit->trx,
            'userID' => auth()->id(),
            'redirect' => url()->full(),
        ]);

        return ['type' => 'success', 'data' => $payment_url];
    }

    public function callback(Request $request)
    {
        return LaravelCryptoPaymentGateway::callback();
    }

    public static function success($cryptoPaymentModel, $payment_details, $box_status)
    {
        if ($cryptoPaymentModel) {

            if (session('type') == 'deposit') {
                $userOrder = Deposit::where('trx', $cryptoPaymentModel->paymentID)->first();
            } else {
                $userOrder = Payment::where('trx', $cryptoPaymentModel->paymentID)->first();
            }


            // Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
            if ($userOrder && $box_status == "cryptobox_updated") {
                $userOrder->txconfirmed = $payment_details["confirmed"];
                $userOrder->save();
            }


            // Onetime action when payment confirmed (6+ transaction confirmations)
            if (!$cryptoPaymentModel->processed && $payment_details["confirmed"]) {
                // Add your custom logic here to give value to the user.

                Helper::paymentSuccess($userOrder, floatval($payment_details["amount"]), $cryptoPaymentModel->paymentID);

                // ------------------
                // set the status of the payment to processed
                // $cryptoPaymentModel->setStatusAsProcessed();

                // ------------------
                // Add logic to send notification of confirmed/processed payment to the user if any
            }
        }
        return true;
    }
}
