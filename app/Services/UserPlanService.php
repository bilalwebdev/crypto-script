<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanSubscription;
use App\Models\Template;
use App\Models\Transaction;
use App\Notifications\PlanSubscriptionNotification;
use Illuminate\Support\Str;
use DB;

class UserPlanService
{
    public function subscribe($request)
    {
        $general = Configuration::first();

        $plan = Plan::find($request->payment);

        if (!$plan) {
            return ['type' => 'error', 'message' => 'Plan Not Found'];
        }

        $user = auth()->user();

        $data['user_id'] = auth()->id();

        $data['transaction_id'] = Str::upper(Str::random(16));

        $data['amount'] = $plan->price ?? 0;

        $data['gateway_id'] = null;

        $data['plan_id'] = $plan->id;

        $data['charge'] = 0;

        $data['rate'] = 1;

        $data['final_amount'] = ($data['amount'] * $data['rate']) + $data['charge'];

        // subscription is free
        if ($plan->price_type === 'free') {

            $data['plan_expired_at'] = $plan->plan_type === 'limited' ? now()->addDays($plan->duration) : now()->addYear(50);
            $data['payment_status'] = 1;
            $data['payment_type'] = 1;

            $subscription = $this->subscription($data);

            $admin = Admin::where('type', 'super')->first();

            $admin->notify(new PlanSubscriptionNotification($subscription));

            return ['type' => 'success', 'message' => 'Subscription on a free plan'];
        } else {

            if ($request->payment_type === 'balance') {
                // Subscription using Balance

                if ($user->balance < $plan->price) {
                    return ['type' => 'error', 'message' => 'Insufficient Balance'];
                }


                $data['plan_expired_at'] = $plan->plan_type === 'limited' ? now()->addDays($plan->duration) : now()->addYear(50);
                $data['payment_status'] = 1;
                $data['payment_type'] = 1;

                $subscription = $this->subscription($data);
                $payment = $this->makePayment($data);

                $user->balance = $user->balance - $data['final_amount'];

                $user->save();

                $this->makeTransaction($data);

                Helper::referMoney(auth()->id(), $payment->user->refferedBy, 'invest', $payment->amount);

                $admin = Admin::where('type', 'super')->first();

                $admin->notify(new PlanSubscriptionNotification($subscription));


                $template = Template::where('name', 'plan_subscription')->where('status', 1)->first();

                if ($template) {
                    Helper::fireMail([
                        'app_name' => Helper::config()->appname,
                        'email' => $user->email,
                        'username' => $user->username,
                        'plan' => $payment->plan->name ?? 'deposit',
                        'trx' => $payment->trx,
                        'amount' => $payment->total,
                    ], $template);
                }

                return ['type' => 'success', 'message' => 'Subscription successfull'];
            } else {

                $isAlreadySubscribed = $user->subscriptions()->where('plan_id', $plan->id)->where('is_current', 1)->first();

                if ($isAlreadySubscribed) {
                    return ['type' => 'error', 'message' => 'Already Subscribed to this plan'];
                }

                return ['type' => 'redirect', 'message' => route('user.gateways', $plan->id)];
            }
        }
    }


    private function makeTransaction($data)
    {
        Transaction::create([
            'trx' => $data['transaction_id'],
            'user_id' => $data['user_id'],
            'amount' => $data['final_amount'],
            'charge' => $data['charge'],
            'details' => 'Payment For Subscription',
            'type' => '-'
        ]);
    }

    private function makePayment($data)
    {
        return Payment::create([
            'plan_id' => $data['plan_id'],
            'gateway_id' => $data['gateway_id'] ?? 0,
            'user_id' => $data['user_id'],
            'trx' => $data['transaction_id'],
            'amount' => $data['amount'],
            'rate' => $data['rate'],
            'charge' => $data['charge'],
            'total' => $data['final_amount'],
            'status' => $data['payment_status'],
            'plan_expired_at' => $data['plan_expired_at'],
        ]);
    }

    private function subscription($data)
    {

        $subscription = auth()->user()->subscriptions;

        if ($subscription) {
            DB::table('plan_subscriptions')->where('user_id', auth()->id())->update(['is_current' => 0]);
        }


        $id = PlanSubscription::create([
            'plan_id' => $data['plan_id'],
            'user_id' => $data['user_id'],
            'is_current' => 1,
            'plan_expired_at' => $data['plan_expired_at']
        ]);

        return $id;
    }
}
