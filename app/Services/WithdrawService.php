<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;
use App\Models\Template;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use Carbon\Carbon;
use DB;

class WithdrawService
{
    public function create($request)
    {
        WithdrawGateway::create([
            'name' => $request->name,
            'min_withdraw_amount' => $request->min_amount,
            'max_withdraw_amount' => $request->max_amount,
            'type' => $request->charge_type,
            'charge' => $request->charge,
            'status' => $request->status,
            'instruction' => $request->withdraw_instruction
        ]);


        return ['type' => 'success', 'message' => 'Withdraw Method Created'];
    }

    public function update($request)
    {
        $method = WithdrawGateway::find($request->id);

        $method->update([
            'name' => $request->name,
            'min_withdraw_amount' => $request->min_amount,
            'max_withdraw_amount' => $request->max_amount,
            'type' => $request->charge_type,
            'charge' => $request->charge,
            'status' => $request->status,
            'instruction' => $request->withdraw_instruction
        ]);

        return ['type' => 'success', 'message' => 'Withdraw Method Updated'];
    }

    public function delete($request)
    {
        $method = WithdrawGateway::find($request->id);

        $ifPending = $method->withdrawLogs()->where('status', 0)->count();

        if ($ifPending > 0) {
            return ['type' => 'error', 'message' => 'Withdraw request is pending under this method.'];
        }

        $method->delete();

        return ['type' => 'success', 'message' => 'Withdraw Method Deleted Successfully'];
    }

    public function filter($request)
    {
        $withdraws = Withdraw::query();

        if ($request->status === 'pending') {
            $withdraws->where('status', 0);
        } elseif ($request->status === 'accepted') {
            $withdraws->where('status', 1);
        } elseif ($request->status === 'rejected') {
            $withdraws->where('status', 2);
        }


        if ($request->ajax()) {

            $data['withdraws'] = $withdraws->when($request->key, function ($query) use ($request) {
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
            })->latest()->with('withdrawMethod', 'user')->get();


            return ['is_ajax' => true, 'type' => 'success', 'data' => $data];
        }



        $data['withdraws'] = $withdraws->when($request->search, function ($item) use ($request) {

            $item->where('trx', $request->search);
        })->latest()->with('withdrawMethod', 'user')->paginate(Helper::pagination());


        return ['is_ajax' => false, 'type' => 'success', 'data' => $data];
    }


    public function accept($withdraw)
    {
        $general = Configuration::first();

        $withdraw->status = 1;
        $withdraw->save();

        $template = Template::where('name', 'withdraw_accepted')->where('status', 1)->first();

        if ($template) {
            Helper::fireMail([
                'username'=>  $withdraw->user->username,
                'email' =>  $withdraw->user->email,
                'app_name' => $general->app_name,
                'amount' => $withdraw->withdraw_amount, 
                'method' => optional($withdraw->withdrawMethod)->name, 
                'currency' => $general->currency
            ], $template);
        }

        return ['type' => 'success', 'message' => 'Withdraw Accepted Successfully'];
    }


    public function reject($withdraw, $request)
    {
        $general = Configuration::first();

        $withdraw->status = 2;
        $withdraw->reject_reason = $request->reason_of_reject;
        $withdraw->save();

        $withdraw->user->balance = $withdraw->user->balance + $withdraw->withdraw_amount;
        $withdraw->user->save();

        Transaction::create([
            'trx' => $withdraw->trx,
            'user_id' => $withdraw->user->id,
            'amount' => $withdraw->withdraw_amount,
            'charge' => $withdraw->withdraw_charge,
            'details' => 'Rejected Withdraw via ' . optional($withdraw->withdrawMethod)->name,
            'type' => '+'
        ]);

        $template = Template::where('name', 'withdraw_rejected')->where('status', 1)->first();

        if ($template) {
            Helper::fireMail([
                'username'=>  $withdraw->user->username,
                'email' =>  $withdraw->user->email,
                'app_name' => $general->app_name,
                'amount' => $withdraw->withdraw_amount, 
                'method' => optional($withdraw->withdrawMethod)->name, 
                'currency' => $general->currency, 
                'reason' => $withdraw->reject_reason
            ], $template);
        }

        return ['type' => 'success', 'message' => 'Withdraw Rejected Successfully'];
    }

    public function log($request, $id)
    {
        $gateway = WithdrawGateway::findOrFail($id);

        $data['title'] = $gateway->name . ' withdraw details';

        $data['logs'] = $gateway->withdrawLogs()->when($request->search, function ($item) use ($request) {
            $item->where('trx', $request->search);
        })->with('withdrawMethod', 'user')->paginate(Helper::pagination());


        $data['total'] = $gateway->withdrawLogs()->whereStatus(true)->sum('withdraw_amount');
        $data['pending'] = $gateway->withdrawLogs()->whereStatus(0)->sum('withdraw_amount');
        $data['rejected'] = $gateway->withdrawLogs()->whereStatus(2)->sum('withdraw_amount');

        $data['currentMonthDay'] = collect([]);
        $data['currentMonthWithdraw'] = collect([]);


        $data['previousMonthDay'] = collect([]);
        $data['previousMonthWithdraw'] = collect([]);


        $data['lastYearMonth'] = collect([]);
        $data['lastYearWithdraw'] = collect([]);

        $gateway->withdrawLogs()->with('withdrawMethod', 'user')->whereMonth('created_at', now())->select(DB::raw('SUM(withdraw_amount) as total'), DB::raw('DAY (created_at) day'))
            ->groupby('day')->get()->map(function ($item) use ($data) {
                $data['currentMonthDay']->push($item->day);
                $data['currentMonthWithdraw']->push($item->total);
            });


        $gateway->withdrawLogs()->with('withdrawMethod', 'user')->whereMonth('created_at', now()->subMonth())->select(DB::raw('SUM(withdraw_amount) as total'), DB::raw('DAY (created_at) day'))
            ->groupby('day')->get()->map(function ($item) use ($data) {
                $data['previousMonthDay']->push($item->day);
                $data['previousMonthWithdraw']->push($item->total);
            });


        $gateway->withdrawLogs()->with('withdrawMethod', 'user')->select(DB::raw('SUM(withdraw_amount) as total'), DB::raw('MONTHNAME (created_at) month'))
            ->groupby('month')->get()->map(function ($item) use ($data) {
                $data['lastYearMonth']->push($item->month);
                $data['lastYearWithdraw']->push($item->total);
            });

        return ['type' => 'success', 'data' => $data];
    }
}
