<?php

namespace App\Http\Controllers\backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Payment;
use App\Models\PlanSubscription;
use App\Models\Template;
use App\Models\Transaction;
use App\Notifications\PlanSubscriptionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {

        $dates = [];
        
        if($request->dates){
            $dates = array_map(function($q){
                return Carbon::parse($q);
            }, explode('-', $request->dates));
        }

        $type = $request->type === 'online' ? 1 : 0;

        $payment = Payment::query();

        if ($type) {
            $payment->onlinePayment();
        } else {
            $payment->offlinePayment();
        }

        $data['title'] = 'Manage payments';

        $data['payments'] = $payment->when($request->dates, function($q) use ($dates){
            $q->whereBetween('created_at', $dates);
        })->search($request->search)->latest()->with('plan', 'gateway', 'user')->paginate(Helper::pagination());

        return view('backend.payments.index')->with($data);
    }

    public function details($id)
    {
        $data['payment'] = Payment::findOrFail($id);

        $data['title'] = 'Payment Details';

        return view('backend.payments.details')->with($data);
    }


    public function accept(Request $request)
    {
        $payment = Payment::where('trx', $request->trx)->firstOrFail();

        $general = Configuration::first();

        $gateway = $payment->gateway;

        $payment->status = 1;

        $payment->save();


        Helper::referMoney($payment->user_id, $payment->user->refferedBy, 'invest', $payment->amount);

        $admin = Admin::where('type', 'super')->first();

        $data = [
            'plan_id' => $payment->plan_id,
            'user_id' => $payment->user_id,
            'expired' => $payment->plan_expired_at
        ];

        $subscription = $this->subscription($data, $payment->user);

        $admin->notify(new PlanSubscriptionNotification($subscription));

        Transaction::create([
            'trx' => $payment->trx,
            'amount' => $payment->amount,
            'details' => 'Payment Successfull',
            'charge' => $gateway->charge,
            'type' => '-',
            'user_id' => $payment->user_id
        ]);

        $templete = Template::where('name', 'payment_confirmed')->where('status',1)->first();

        if($templete){
            Helper::fireMail([
                'username'=>$payment->user->username,
                'email' => $payment->user->email,
                'app_name' => $general->app_name,
                'trx' => $payment->trx, 
                'amount' => $payment->amount, 
                'charge' => number_format($gateway->charge, 4), 
                'plan' => $payment->plan->name, 
                'currency' => $general->currency
            ], $templete);
        }

        return redirect()->back()->with('success', "Payment Confirmed Successfully");
    }

    public function reject(Request $request)
    {

        $payment = Payment::where('trx', $request->trx)->firstOrFail();

        $general = Configuration::first();

        $gateway = $payment->gateway;

        $payment->rejection_reason = $request->reason;
        $payment->status = 3;

        $payment->save();

        $templete = Template::where('name', 'payment_rejected')->where('status',1)->first();

        if($templete){
            Helper::fireMail([
                'username'=>$payment->user->username,
                'email' => $payment->user->email,
                'app_name' => $general->app_name,
                'trx' => $payment->trx, 
                'amount' => $payment->amount, 
                'charge' => number_format($gateway->charge, 4), 
                'plan' => $payment->plan->name, 
                'currency' => $general->currency
            ], $templete);
        }

        return back()->with('success', "Payment Rejected Successfully");
    }

    private function subscription($data, $user)
    {
        $subscription = $user->subscriptions;

        if ($subscription) {
            DB::table('plan_subscriptions')->where('user_id', $user->id)->update(['is_current' => 0]);
        }

        $id = PlanSubscription::create([
            'plan_id' => $data['plan_id'],
            'user_id' => $data['user_id'],
            'is_current' => 1,
            'plan_expired_at' => $data['expired']
        ]);

        return $id;
    }
}
