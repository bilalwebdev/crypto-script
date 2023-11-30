<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {

       
        $data['title'] = __('Admin Dashboard');

        $data['totalDeposit'] = Deposit::where('status', 1)->sum('amount');
        $data['pendingDeposit'] = Deposit::where('status', 2)->sum('amount');


        $data['totalWithdraw'] = Withdraw::where('status', 1)->sum('withdraw_amount');
        $data['pendingWithdraw'] = Withdraw::where('status', 0)->sum('withdraw_amount');

        $data['totalUser'] = User::count();
        $data['pendingUser'] = User::where('status', 0)->count();
        $data['activeUser'] = User::where('status', 1)->count();
        $data['emailUser'] = User::where('status', 1)->where('is_email_verified',1)->count();

        $data['totalTicket'] = Ticket::count();
        $data['pendingTicket'] = Ticket::whereStatus(2)->count();

        $data['totalOnlineGateway'] = Gateway::where('type', 1)->count();
        $data['totalOfflineGateway'] = Gateway::where('type', 0)->count();
        $data['totalWithdrawGateway'] = WithdrawGateway::where('status', 1)->count();

        $data['totalStaff'] = Admin::where('type', '!=', 'super')->count();
        $data['users'] = User::search($request->search)->latest()->paginate(Helper::pagination(),['*'],'users');


        $data['subscriptionAmount'] = Payment::where('status', 1)->sum('amount');
        $data['charge'] = Payment::where('status', 1)->sum('charge');
        $data['pending_payment'] = Payment::where('status', 2)->sum('amount');
        $data['plan_expired_user'] = Payment::where('status', 1)->pluck('user_id')->unique()->count();

        $months = array();

        $totalAmount = array();
        $withdrawTotalAmount = array();
        $depositsTotalAmount = array();

        $payments = Payment::where('status', 1)
            ->select(DB::raw('SUM(total) as total'), DB::raw('MONTHNAME(created_at) month'))
            ->groupby('month')
            ->get();
        $withdraws = Withdraw::where('status', 1)
            ->select(DB::raw('SUM(withdraw_amount) as total'), DB::raw('MONTHNAME(created_at) month'))
            ->groupby('month')
            ->get();

        $deposits = Deposit::where('status', 1)
            ->select(DB::raw('SUM(total) as total'), DB::raw('MONTHNAME(created_at) as month'))
            ->groupby('month')
            ->get();


        for ($i = 11; $i >= 0; $i--) {

            $month = Carbon::today()->startOfMonth()->subMonth($i);

            array_push($months, $month->monthName);

            array_push($totalAmount, 0);
            array_push($withdrawTotalAmount, 0);
            array_push($depositsTotalAmount, 0);
        }

        foreach ($payments as $payment) {
            if (in_array($payment->month, $months)) {
                $index = array_search($payment->month, $months);

                $totalAmount[$index] = $payment->total;
            }
        }


        foreach ($withdraws as $withdraw) {
            if (in_array($withdraw->month,$months)) {
                $index = array_search($withdraw->month, $months);

                $withdrawTotalAmount[$index] = $withdraw->total;
            }
        }


        foreach ($deposits as $deposit) {
            if (in_array($deposit->month,$months)) {
                $index = array_search($deposit->month, $months);

                $depositsTotalAmount[$index] = $deposit->total;
            }
        }

        $data['months'] = $months;
        $data['totalAmount'] = $totalAmount;
        $data['withdrawTotalAmount'] = $withdrawTotalAmount;
        $data['depositsTotalAmount'] = $depositsTotalAmount;

        $data['browser'] = UserLog::select(DB::raw('COUNT(browser) as total'),'browser')->groupBy('browser')->get();

        $data['logTotal'] = UserLog::count();
       


        $data['investments'] = Payment::when($request->trx, function($item) use($request){

            $item->where('transaction_id', $request->trx);

        })->where('status',1)->latest()->with('user','plan')->limit(4)->get();



        $data['deposits'] = Deposit::where('status',1)->latest()->with('user')->limit(4)->get();
        $data['withdraws'] = Withdraw::where('status',1)->latest()->with('user','withdrawMethod')->limit(4)->get();
        

     

        return view('backend.dashboard')->with($data);
    }
}
