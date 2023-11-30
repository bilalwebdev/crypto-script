<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Http\Requests\UserMoneyTransferRequest;
use App\Models\MoneyTransfer;
use App\Services\UserMoneyTransferService;
use Illuminate\Http\Request;

class MoneyTransferController extends Controller
{

    protected $transfer;

    public function __construct(UserMoneyTransferService $transfer)
    {
        $this->transfer = $transfer;
    }
    public function transfer()
    {
        $data['title'] = 'Transfer Money';

        return view(Helper::theme() . 'user.transfer_money')->with($data);
    }

    public function transferMoney(UserMoneyTransferRequest $request)
    {

        $isSuccess = $this->transfer->transferMoney($request);

        if ($isSuccess['type'] === 'error') {
            return back()->with('error', $isSuccess['message']);
        }

        return back()->with('success', $isSuccess['message']);
    }

    public function transferMoneyLog(Request $request)
    {
        $data['title'] = 'Transfer Money Log';

        $data['transferMoneys'] = MoneyTransfer::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('sender_id', auth()->id())->latest()->with('receiver')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.transfermoney_log')->with($data);
    }

    public function receiveMoneyLog(Request $request)
    {
        $data['title'] = 'Receive Money Log';

        $data['transferMoneys'] = MoneyTransfer::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('receiver_id', auth()->id())->latest()->with('sender')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.transfermoney_log')->with($data);
    }
}
