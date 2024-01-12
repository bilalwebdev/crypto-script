<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use App\Services\MT5\MT5Service;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
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
        
      
        if ($request->transac_type == 'dep') {

            $dep = Deposit::create([
                'user_id' => $request->user_id,
                'payment_method_id' => 1,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 1
            ]);

        

            return redirect('admin/transac/confirm?type=dep&transaction_id='.$dep->id);
         
        } else {
          
            $with = Withdraw::create([
                'user_id' => $request->user_id,
                'payment_method_id' => 1,
                'amount' => $request->amount,
                'login' => $request->login,
                'status' => 1
            ]);


            return redirect('admin/transac/confirm?type=with&transaction_id='.$with->id);
          
        }



        // $data['title'] = 'Transaction';

        // $data['users'] = User::with('accounts')->paginate(10);
        // //   dd($data);

     
    }


    public function confirmTrans(Request $request){
       
        $data['title'] = 'Confirm Transaction';
        $data['dep']= Deposit::where('id', $request->transaction_id)->firstOrFail();
        $data['type'] = $request->type;
        $data['payment_methods'] = PaymentMethod::where('status', 1)->get()->toArray();

    
        return view('backend.transactions.transaction-success')->with($data);
    }

    public function finalTrans(Request $request){
      

      

        if($request->transac_type == 'dep'){
            $transac = Deposit::where('id', $request->transac_id)->firstOrFail();
            // $general = Configuration::first();

            // $gateway = Gateway::find($transac->gateway_id);

            $transac->update([
                'payment_method_id' => $request->payment_method_id
            ]);

           $transac->user->balance = $transac->user->balance + $transac->amount;

           $transac->payment_method_id = $request->payment_method_id;   

           $transac->user->save();

           $this->mt5service->deposit($transac->login, $transac->amount, 'false');


            Transaction::create([
                'amount' => $transac->amount,
                'details' => 'Deposit Successfull',
                // 'charge' => $gateway->charge,
                'type' => '+',
                'user_id' => $transac->user_id
            ]);

            return redirect()->back()->with('success', "Transaction Done Successfully");
        }else{

            $transac = Withdraw::where('id', $request->transac_id)->firstOrFail();
            // $general = Configuration::first();

            // $gateway = Gateway::find($transac->gateway_id);

            $transac->update([
                'payment_method_id' => $request->payment_method_id
            ]);

            $transac->user->balance = $transac->user->balance + $transac->amount;

            $transac->user->save();

            $this->mt5service->deposit($transac->login, $transac->amount, 'true');


            Transaction::create([
                'amount' => $transac->amount,
                'details' => 'Withdraw Successfull',
                // 'charge' => $gateway->charge,
                'type' => '-',
                'user_id' => $transac->user_id
            ]);

            return redirect()->back()->with('success', "Transaction Done Successfully");
        }
    }
}
