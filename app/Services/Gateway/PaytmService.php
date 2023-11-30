<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaytmService
{
    private static $sandbox_endpoint_payment = 'https://securegw-stage.paytm.in/theia/processTransaction';
    private static $production_endpoint_payment = 'https://securegw.paytm.in/theia/processTransaction';

    public static function process($request, $paytm, $totalAmount, $deposit)
    {


        $paytm_params['MID'] = trim($paytm->parameter->merchant_id);
        $paytm_params['WEBSITE'] = trim($paytm->parameter->merchant_website);
        $paytm_params['CHANNEL_ID'] = trim($paytm->parameter->merchant_channel);
        $paytm_params['INDUSTRY_TYPE_ID'] = trim($paytm->parameter->merchant_industry);


        $paytm_params['ORDER_ID'] = $deposit->trx;
        $paytm_params['TXN_AMOUNT'] = round($totalAmount, 2);
        $paytm_params['CUST_ID'] = $deposit->user_id;
        $paytm_params['CALLBACK_URL'] = route('user.payment.success', $paytm->name);
        $paytm_params['CHECKSUMHASH'] = (new paytmCheckSum())->getChecksumFromArray($paytm_params, $paytm->parameter->merchant_key);

        $response['paytm_params'] = $paytm_params;
        if ($paytm->parameter->mode) {
            $response['redirect_url'] = self::$production_endpoint_payment;
        } else {
            $response['redirect_url'] = self::$sandbox_endpoint_payment;
        }


        return ['type' => 'success', 'data' => json_decode(json_encode($response))];
    }

    public function success(Request $request)
    {

        if (session('type') == 'deposit') {
            $payment = Deposit::where('trx', $request['ORDERID'])->first();
        } else {
            $payment = Payment::where('trx', $request['ORDERID'])->first();
        }



        $ptm = new paytmCheckSum();

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
        $isValidChecksum = $ptm->verifychecksum_e($paramList, $payment->gateway->parameter->merchant_key, $paytmChecksum);

        $amount_paid = $request['TXNAMOUNT'];

        if ($isValidChecksum == "TRUE") {
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                $payment_mode = $request['PAYMENTMODE'];
                if (isset($_POST['BANKNAME']) && !empty($request['BANKNAME'])) {
                    $payment_id = $request['BANKNAME'] . '-' . $request['BANKTXNID'];
                } else {
                    $payment_id = $request['BANKTXNID'];
                }
                $order_id   = $request['ORDERID'];
                $amount_received = $request['TXNAMOUNT'];

                Helper::paymentSuccess($payment, 0, $request['BANKTXNID']);
            } else {
                return array('type' => 'error', 'message' => 'Payment Unsuccessfull');
            }
        } else {
            return array('type' => 'error', 'message' => 'Some Error Occured');
        }

        return array('type' => 'success', 'message' => 'Payment Successfull');
    }
}
