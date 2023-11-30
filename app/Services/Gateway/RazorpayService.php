<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;

class RazorPayService
{
    public static function success($request)
    {
        $request = $request->all();

        if (session('type') == 'deposit') {
            $deposit = Deposit::where('trx', session('trx'))->first();
        } else {
            $deposit = Payment::where('trx', session('trx'))->first();
        }

        if (isset($request['razorpay_payment_id'])) {

            Helper::paymentSuccess($deposit, 0, $request['razorpay_payment_id']);

            return ['type' => 'success', 'message' => 'Payment Successfull'];
        }

        return ['type' => 'error', 'message' => 'Something Went Wrong'];
    }
}
