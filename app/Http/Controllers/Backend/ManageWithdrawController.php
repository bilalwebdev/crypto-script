<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use App\Services\WithdrawService;
use Illuminate\Http\Request;

class ManageWithdrawController extends Controller
{
    protected $gateway;

    public function __construct(WithdrawService $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Withdraw Methods';

        $search = $request->search;

        $data['withdraws'] = WithdrawGateway::when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->paginate(Helper::pagination());

        return view('backend.withdraw.index')->with($data);
    }

    public function withdrawMethodCreate(WithdrawRequest $request)
    {
        $isSuccess = $this->gateway->create($request);

        if ($isSuccess['type'] == 'success')
            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function withdrawMethodUpdate(WithdrawRequest $request)
    {
        $isSuccess = $this->gateway->update($request);

        if ($isSuccess['type'] == 'success')
            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function withdrawMethodDelete(Request $request)
    {
        $isSuccess = $this->gateway->delete($request);

        if ($isSuccess['type'] == 'error') {

            return redirect()->back()->with('error', $isSuccess['message']);
        }

        return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function filterWithdraw(Request $request)
    {

        $data = $this->gateway->filter($request);

        $data['title'] = 'Withdraw Logs';

        if ($data['is_ajax']) {
            return view('backend.withdraw.withdraw_ajax')->with($data);
        }

        return view('backend.withdraw.withdraw_all')->with($data);
    }

    public function withdrawAccept(Withdraw $withdraw)
    {
        $isSuccess = $this->gateway->accept($withdraw);

        if ($isSuccess['type'] === 'success')
            return redirect()->back()->with('success', 'Withdraw Accepted Successfully');
    }

    public function withdrawReject(Request $request, Withdraw $withdraw)
    {
        $request->validate(['reason_of_reject' => 'required']);

        $isSuccess = $this->gateway->reject($withdraw, $request);

        if ($isSuccess['type'] === 'success')
            return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function withdrawLog(Request $request, $id)
    {
        $isSuccess = $this->gateway->log($request, $id);

        return view('backend.withdraw.details')->with($isSuccess['data']);
    }
}
