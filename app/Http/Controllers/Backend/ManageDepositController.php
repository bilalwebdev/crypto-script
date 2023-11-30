<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Template;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageDepositController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->status === 'online' ? 1 : 0;

        $deposit = Deposit::query();

        if($request->search){
            $deposit->search($request->search);
        }

        if($request->date){

            $date = array_map(function($item){
                return Carbon::parse($item);
            },explode(' - ', $request->date));

            $deposit->whereBetween('created_at', $date);
        }


        if($type == 1){
            $deposit->where('status',1);
        }else{
            $deposit->where('type', $type);
        }

        $data['deposits'] = $deposit->with('gateway','user')->latest()->paginate( Helper::pagination());

        $data['title'] = 'Manage Deposits';

        return view('backend.deposit.index')->with($data);

    }


    public function details($trx)
    {
        $data['deposit'] = Deposit::where('trx', $trx)->firstOrFail();

        $data['title'] = 'Deposit Details';


        return view('backend.deposit.details')->with($data);
    }

    public function accept(Request $request)
    { 
        
        $deposit = Deposit::where('trx', $request->trx)->firstOrFail();
        

        $general = Configuration::first();

        $gateway = Gateway::find($deposit->gateway_id);

        $deposit->status = 1;
        $deposit->save();


        $deposit->user->balance = $deposit->user->balance + $deposit->amount;

        $deposit->user->save();


        Transaction::create([
            'trx' => $deposit->trx,
            'amount' => $deposit->amount,
            'details' => 'Deposit Successfull',
            'charge' => $gateway->charge,
            'type' => '+',
            'user_id' => $deposit->user_id
        ]);


        $template = Template::where('name','payment_confirmed')->where('status',1)->first();

        if($template){

            $data = [
                'username' => $deposit->user->username,
                'email' => $deposit->user->email,
                'app_name' => $general->appname,
                'trx' => $deposit->trx, 
                'amount' => $deposit->amount, 
                'charge' => number_format($gateway->charge, 4), 
                'plan' => '', 
                'currency' => $general->currency
            ];

            Helper::fireMail($data, $template);
        }

        return redirect()->back()->with('success', "Payment Confirmed Successfully");
        
    }

    public function reject(Request $request)
    { 
        
        $deposit = Deposit::where('trx', $request->trx)->firstOrFail();
        
        $general = Configuration::first();

        $gateway = Gateway::find($deposit->gateway_id);

        $deposit->status = 3;
        $deposit->save();


        $template = Template::where('name','payment_rejected')->where('status',1)->first();

        if($template){

            $data = [
                'username' => $deposit->user->username,
                'email' => $deposit->user->email,
                'app_name' => $general->appname,
                'trx' => $deposit->trx, 
                'amount' => $deposit->amount, 
                'charge' => number_format($gateway->charge, 4), 
                'plan' => '', 
                'currency' => $general->currency
            ];

            Helper::fireMail($data, $template);
        }


        return back()->with('success', "Payment Rejected Successfully");
        
    }
}
