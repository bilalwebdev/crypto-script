<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\MT5\MT5Service;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    protected $mt5service;
    public function __construct(MT5Service $mt5service)
    {
        $this->mt5service = $mt5service;
    }

    public function trans()
    {

        $data['title'] = 'Transaction';

        $data['users'] = User::with('accounts')->paginate(10);
        //   dd($data);

        return view('backend.transactions.index')->with($data);
    }

    public function storeTrans(Request $request)
    {

        // dd($request->transac_type);
        if ($request->transac_type == 'dep') {

            $dep = Deposit::create([
                'user_id' => $request->user_id,
                'payment_method_id' => 1,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 1
            ]);


            $deposit = Deposit::where('id', $dep->id)->firstOrFail();

            // $general = Configuration::first();

            // $gateway = Gateway::find($deposit->gateway_id);




            $deposit->user->balance = $deposit->user->balance + $deposit->amount;

            $deposit->user->save();

            $this->mt5service->deposit($deposit->login, $deposit->amount, 'false');




            Transaction::create([
                'amount' => $deposit->amount,
                'details' => 'Deposit Successfull',
                // 'charge' => $gateway->charge,
                'type' => '+',
                'user_id' => $deposit->user_id
            ]);
        } else {
            $with = Withdraw::create([
                'user_id' => $request->user_id,
                'payment_method_id' => 1,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 1
            ]);


            $deposit = Withdraw::where('id', $with->id)->firstOrFail();

            // $general = Configuration::first();

            // $gateway = Gateway::find($deposit->gateway_id);



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
        }



        // $data['title'] = 'Transaction';

        // $data['users'] = User::with('accounts')->paginate(10);
        // //   dd($data);

        return redirect()->back()->with('success', "Transaction Done Successfully");
    }
}
