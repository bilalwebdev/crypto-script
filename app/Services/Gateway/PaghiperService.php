<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaghiperService
{
    public static function process($request, $gateway, $amount, $deposit)
    {

        \PagHipperSDK\Auth::init(
            $gateway->parameter->paghiper_key,
            $gateway->parameter->token
        );

        $pagHiper = new \PagHipperSDK\PagHiper();
        $items = [];
        $items[] = (new \PagHipperSDK\Entities\Item())
            ->setItemId($deposit->id)
            ->setDescription('Plan Purchase')
            ->setQuantity(1)
            ->setPriceCents($amount);

        $payer = (new \PagHipperSDK\Entities\Payer())
            ->setPayerEmail(auth()->user()->email)
            ->setPayerName(auth()->user()->username)
            ->setPayerCpfCnpj($request->cpf);


        $transaction = (new \PagHipperSDK\Entities\Transaction())
            ->setOrderId($deposit->trx)
            ->setNotificationUrl(route('user.payment.success', $gateway->name))
            ->setShippingMethods('PAC')
            ->setFixedDescription(true)
            ->setDaysDueDate('3')
            ->setPayer($payer)
            ->setItems($items);

        $transaction = $pagHiper->createTransaction($transaction);


        return ['type' => 'success', 'data' => $transaction->getBankSlip()->getUrlSlip()];
    }

    public function success(Request $request)
    {

        $transaction = \PagHipperSDK\Response\GetTransactionPix::populate($request->all());

        if (session('type') == 'deposit') {
            $deposit = Deposit::where('trx', session('trx'))->first();
        } else {
            $deposit = Payment::where('trx', session('trx'))->first();
        }

        if (isset($request->transaction_id)) {

            Helper::paymentSuccess($deposit, 0, $transaction->getOrderId());

            return ['type' => 'success', 'message' => 'Plan Subscribed Successfully'];
        }
    }
}
