<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Payment;
use Illuminate\Http\Request;

class VougepayService
{
    public function success(Request $request)
    {

        $request->validate([
            'transaction_id' => 'required'
        ]);
        $vougue_url = "https://voguepay.com/?v_transaction_id=$request->transaction_id&type=json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_URL, $vougue_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $vougueData = curl_exec($ch);
        curl_close($ch);

        $vougueData = json_decode($vougueData);
        $transaction_id = $vougueData->merchant_ref;

        $deposit = Payment::where('trx', $transaction_id)->first();
        if ($vougueData->status == "Approved") {
            Helper::paymentSuccess($deposit, $deposit->charge, $request->transaction_id);

            return ['type' => 'success', 'message' => 'Payment Successfull'];
        }

        return ['type' => 'error', 'message' => 'Payment Successfull'];
    }
}
