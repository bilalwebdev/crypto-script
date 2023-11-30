<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\MoneyTransfer;
use App\Models\Payment;
use App\Models\Trade;
use App\Models\ReferralCommission;
use App\Models\RefferedCommission;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function tradeLog(Request $request)
    {
        $user = User::find($request->user);
        $trades = Trade::query();

        if ($user) {
            $trades->where('user_id', $user->id);
        }

        $data['title'] = 'Wheel Log';

        if ($request->ajax()) {

            $trades = $this->ajaxFilter($trades->with('user'), $request);

            return view('backend.logs.trade_ajax', compact('trades'));
        }

        $data['trades'] = $trades->orderBy('id','desc')->with('user')->paginate(Helper::pagination());

        return view('backend.logs.trade_log')->with($data);
    }


    public function transaction(Request $request)
    {
        $user = User::find($request->user);

        $data['title'] = 'Transaction Log';

        $transactions = Transaction::query();

        if ($user) {
            $transactions->where('user_id', $user->id);
        }

        if ($request->search) {
            $transactions->where('trx', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->ajax()) {

            $transactions = $this->ajaxFilter($transactions->with('user'), $request);

            return view('backend.logs.transaction_ajax', compact('transactions'));
        }

        $data['transactions'] = $transactions->latest()->with('user')->paginate(Helper::pagination());

        return view('backend.logs.transaction')->with($data);
    }


    public function Commision(Request $request,  $user = '')
    {

        $user = User::find($user);

        $commisons = ReferralCommission::query();

        if ($user) {
            $commisons->where('commission_to', $user->id);
        }

        if ($request->ajax()) {
            $commisons = $this->ajaxFilter($commisons->with('whoGetTheMoney', 'whoSendTheMoney'), $request);

            return view('backend.logs.commission_ajax', compact('commisons'));
        }

        $commisons = $commisons->latest()->with('whoGetTheMoney', 'whoSendTheMoney')->paginate(Helper::pagination());

        $title = 'Commission Log';

        return view('backend.logs.commission', compact('commisons', 'title'));
    }


    public function depositLog(Request $request, $user = '')
    {

        $user = User::find($user);

        $data['title'] = "Deposit Log";

        $depo = Deposit::query();

        if ($user) {
            $depo->where('user_id', $user->id);
        }

        if ($request->ajax()) {
            $deposits = $this->ajaxFilter($depo->whereIn('status', [1, 2, 3])->with('user', 'gateway'), $request);

            return view('backend.logs.deposit_ajax', compact('deposits'));
        }

        $data['deposits'] = $depo->whereIn('status', [1, 2, 3])->with('user', 'gateway')->latest()->paginate(Helper::pagination());

        return view('backend.logs.deposit_log')->with($data);
    }

    public function depositDetails(Request $request)
    {
        $title = "Payment Details";

        $manual = Deposit::where('transaction_id', $request->trx)->firstOrFail();

        return view('backend.deposit_details', compact('title', 'manual'));
    }


    public function paymentReport(Request $request, $user = '')
    {

        $user = User::find($user);
        $data['title'] = 'Payment Report';


        $transactions = Payment::where('status', 1);

        if ($user) {
            $transactions->where('user_id', $user->id);
        }

        if ($request->search) {
            $transactions->where('trx', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->ajax()) {

            $transactions = $this->ajaxFilter($transactions->with('user', 'gateway'), $request);

            return view('backend.logs.payment_ajax', compact('transactions'));
        }

        $data['transactions'] = $transactions->latest()->with('gateway', 'user')->paginate(Helper::pagination());



        return view('backend.logs.payment_report')->with($data);
    }


    public function withdarawReport(Request $request, $user = '')
    {
        $user = User::find($user);
        $data['title'] = 'Withdraw Report';

        $data['transactions'] = Withdraw::where('status', 1);

        if ($user) {
            $data['transactions']->where('user_id', $user->id);
        }

        if ($request->search) {
            $data['transactions']->where('transaction_id', 'LIKE', '%' . $request->search . '%');
        }


        if ($request->ajax()) {

            $data['transactions'] = $this->ajaxFilter($data['transactions']->with('user', 'withdrawMethod'), $request);

            return view('backend.logs.withdraw_ajax')->with($data);
        }

        $data['transactions'] = $data['transactions']->latest()->with('user', 'withdrawMethod')->paginate(Helper::pagination());

        return view('backend.logs.withdraw_report')->with($data);
    }

    public function transferLog(Request $request)
    {
        $data['title'] = 'Transfer Log';

        $transfers = MoneyTransfer::query();

        if ($request->search) {
            $transfers->where('transaction_id', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->ajax()) {

            $transfers = $this->ajaxFilter($transfers->with('sender', 'receiver'), $request);

            return view('backend.logs.transfer_ajax', compact('transfers'));
        }



        $data['transfers'] = MoneyTransfer::latest()->with('sender', 'receiver')->paginate(Helper::pagination());

        return view('backend.logs.transfer_report')->with($data);
    }


    public function ajaxFilter($transactions, $request)
    {
        return $transactions->when($request->key, function ($query) use ($request) {
            if ($request->key === 'Today') {
                $query->whereDate('created_at', now());
            } elseif ($request->key === 'Yesterday') {
                $query->whereDate('created_at', now()->subDay());
            } elseif ($request->key === 'Last 7 Days') {
                $query->whereDate('created_at', '>=', now()->subDays(7));
            } elseif ($request->key === 'Last 30 Days') {
                $query->whereDate('created_at', '>=', now()->subDays(30));
            } elseif ($request->key === 'This Month') {
                $query->whereMonth('created_at', now());
            } else {

                [$startdate, $enddate] =  array_map(function ($item) {
                    return Carbon::parse($item);
                }, explode('-', $request->date));

                $query->whereBetween('created_at', [$startdate, $enddate]);
            }
        })->latest()->get();
    }
}
