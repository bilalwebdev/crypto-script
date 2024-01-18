<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use App\Services\MT5\MT5Service;
use App\Services\WithdrawService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageWithdrawController extends Controller
{
    protected $mt5service;
    public function __construct(MT5Service $mt5service)
    {
        $this->mt5service = $mt5service;
    }
    public function index(Request $request)
    {
        $data['title'] = 'Withdraw Methods';

        // $search = $request->search;

        $admin  = Admin::find(session()->get('user_id'));

        if ($admin->type == 'super') {
            $withdraw = Withdraw::query();
        } else {
            $withdraw = Withdraw::leftJoin('admin_users', 'withdraws.user_id', '=', 'admin_users.user_id')
                ->where('admin_users.admin_id', '=', session()->get('user_id'))
                ->select('withdraws.*');
        }

        if ($request->date) {

            $date = array_map(function ($item) {
                return Carbon::parse($item);
            }, explode(' - ', $request->date));

            $withdraw->whereBetween('created_at', $date);
        }

        $data['withdraws'] = $withdraw->with(
            'payment',
            'user'
        )->latest()->paginate(Helper::pagination());

        return view('backend.withdraw.index')->with($data);
    }

    // public function withdrawMethodCreate(WithdrawRequest $request)
    // {
    //     $isSuccess = $this->gateway->create($request);

    //     if ($isSuccess['type'] == 'success')
    //         return redirect()->back()->with('success', $isSuccess['message']);
    // }

    // public function withdrawMethodUpdate(WithdrawRequest $request)
    // {
    //     $isSuccess = $this->gateway->update($request);

    //     if ($isSuccess['type'] == 'success')
    //         return redirect()->back()->with('success', $isSuccess['message']);
    // }

    // public function withdrawMethodDelete(Request $request)
    // {
    //     $isSuccess = $this->gateway->delete($request);

    //     if ($isSuccess['type'] == 'error') {

    //         return redirect()->back()->with('error', $isSuccess['message']);
    //     }

    //     return redirect()->back()->with('success', $isSuccess['message']);
    // }

    // public function filterWithdraw(Request $request)
    // {

    //     $data = $this->gateway->filter($request);

    //     $data['title'] = 'Withdraw Logs';

    //     if ($data['is_ajax']) {
    //         return view('backend.withdraw.withdraw_ajax')->with($data);
    //     }

    //     return view('backend.withdraw.withdraw_all')->with($data);
    // }

    // public function withdrawAccept(Withdraw $withdraw)
    // {
    //     $isSuccess = $this->gateway->accept($withdraw);

    //     if ($isSuccess['type'] === 'success')
    //         return redirect()->back()->with('success', 'Withdraw Accepted Successfully');
    // }

    // public function withdrawReject(Request $request, Withdraw $withdraw)
    // {
    //     $request->validate(['reason_of_reject' => 'required']);

    //     $isSuccess = $this->gateway->reject($withdraw, $request);

    //     if ($isSuccess['type'] === 'success')
    //         return redirect()->back()->with('success', $isSuccess['message']);
    // }

    // public function withdrawLog(Request $request, $id)
    // {
    //     $isSuccess = $this->gateway->log($request, $id);

    //     return view('backend.withdraw.details')->with($isSuccess['data']);
    // }



    public function accept(Request $request)
    {

        $deposit = Withdraw::where('id', $request->id)->firstOrFail();

        //   $general = Configuration::first();

        // $gateway = Gateway::find($deposit->gateway_id);

        $deposit->status = 1;
        $deposit->save();


        $deposit->user->balance = $deposit->user->balance + $deposit->amount;

        $deposit->user->save();

        $this->mt5service->deposit($deposit->login, $deposit->amount, 'true');

        Transaction::create([
            'amount' => $deposit->amount,
            'details' => 'Withdraw Successfull',
            // 'charge' => $gateway->charge,
            'type' => '-',
            'user_id' => $deposit->user_id
        ]);


        // $template = Template::where('name', 'payment_confirmed')->where('status', 1)->first();

        // if ($template) {

        //     $data = [
        //         'username' => $deposit->user->username,
        //         'email' => $deposit->user->email,
        //         'app_name' => $general->appname,
        //         'id' => $deposit->id,
        //         'amount' => $deposit->amount,
        //         'charge' => number_format($gateway->charge, 4),
        //         'plan' => '',
        //         'currency' => $general->currency
        //     ];

        //     Helper::fireMail($data, $template);
        // }

        return redirect()->back()->with('success', "Transaction Done Successfully");
    }

    public function reject(Request $request)
    {

        $deposit = Withdraw::where('id', $request->id)->firstOrFail();

        //  $general = Configuration::first();

        // $gateway = Gateway::find($deposit->gateway_id);

        $deposit->status = 3;
        $deposit->save();


        // $template = Template::where('name', 'payment_rejected')->where('status', 1)->first();

        // if ($template) {

        //     $data = [
        //         'username' => $deposit->user->username,
        //         'email' => $deposit->user->email,
        //         'app_name' => $general->appname,
        //         'id' => $deposit->id,
        //         'amount' => $deposit->amount,
        //         'charge' => number_format($gateway->charge, 4),
        //         'plan' => '',
        //         'currency' => $general->currency
        //     ];

        //     Helper::fireMail($data, $template);
        // }


        return back()->with('success', "Payment Rejected Successfully");
    }
    public function details($id)
    {
        $data['withdraw'] = Withdraw::where('id', $id)->firstOrFail();

        $data['title'] = 'Withdraw Details';


        return view('backend.withdraw.details')->with($data);
    }
}
