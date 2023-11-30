<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Http\Requests\UserWithdrawRequest;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use App\Services\UserWithdrawService;
use Illuminate\Http\Request;

class PayoutController extends Controller
{

    protected $withdrawservice;

    public function __construct(UserWithdrawService $withdrawservice)
    {
        $this->withdrawservice = $withdrawservice;
    }

    public function withdraw()
    {
        $data['title'] = 'Withdraw Money';

        $data['withdraws'] = WithdrawGateway::where('status', 1)->latest()->get();

        return view(Helper::theme() . 'user.withdraw.index')->with($data);
    }

    public function withdrawCompleted(UserWithdrawRequest $request)
    {

        $isSuccess = $this->withdrawservice->makeWithdraw($request);

        if($isSuccess['type'] === 'error'){
            return redirect()->back()->with('error', $isSuccess['message']);
        }

        return redirect()->back()->with('success', $isSuccess['message']);

    }

    public function withdrawFetch(Request $request)
    {
        $withdraw = WithdrawGateway::findOrFail($request->id);

        return $withdraw;
    }

  
}
