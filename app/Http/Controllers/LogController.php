<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\Deposit;
use App\Models\Payment;
use App\Models\PlanSubscription;
use App\Models\ReferralCommission;
use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function depositLog(Request $request)
    {
        $data['title'] = "Deposit Log";

        $data['deposits'] = Deposit::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })
            ->where('user_id', auth()->id())
            ->latest()->with('user')
            ->whereIn('status', [1, 2, 3])
            ->latest()
            ->with('gateway')
            ->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.deposit_log')->with($data);
    }


    public function allWithdraw(Request $request)
    {
        $data['title'] = 'All withdraw';

        $data['withdrawlogs'] = Withdraw::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())->latest()->with('withdrawMethod')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.withdraw.withdraw_log')->with($data);
    }

    public function pendingWithdraw()
    {
        $data['title'] = 'Pending withdraw';

        $data['withdrawlogs'] = Withdraw::where('user_id', auth()->id())->where('status', 0)->latest()->with('withdrawMethod')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.withdraw.withdraw_log')->with($data);
    }

    public function completeWithdraw()
    {
        $data['title'] = 'Complete withdraw';

        $data['withdrawlogs'] = Withdraw::where('user_id', auth()->id())->where('status', 1)->latest()->with('withdrawMethod')->paginate(10);

        return view(Helper::theme() . 'user.withdraw.withdraw_log')->with($data);
    }


    public function investLog(Request $request)
    {
        $data['title'] = 'Invest Log';

        $data['investments'] = Payment::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())->whereIn('status', [1, 2, 3])->latest()->with('user', 'gateway')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.invest_log')->with($data);
    }


    public function transactionLog(Request $request)
    {
        $data['title'] = 'Transaction Log';

        $data['transactions'] = Transaction::with('user')->when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())->latest()->with('user')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.transaction')->with($data);
    }

    public function commision(Request $request)
    {

        $data['title'] = 'Refferal Commission';

        $data['commison'] = ReferralCommission::when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('commission_to', auth()->id())->latest()->with('whoGetTheMoney', 'whoSendTheMoney')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.commision_log')->with($data);
    }

    public function subscriptionLog(Request $request)
    {
        $data['title'] = 'Subscription Log';

        $data['subscriptions'] = PlanSubscription::when($request->date, function ($item) use ($request) {
            $item->whereDate('plan_expired_at', $request->date);
        })->where('user_id', auth()->id())->latest()->with('user', 'plan')->paginate(Helper::pagination());


        return view(Helper::theme() . 'user.subscription_log')->with($data);
    }


    public function refferalLog()
    {
        $data['reference'] = auth()->user()->refferals;

        $data['title'] = 'Refferal Log';

        return view(Helper::theme(). 'user.refferal')->with($data);
    }
}
