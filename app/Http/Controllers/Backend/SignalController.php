<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignalRequest;
use App\Models\CurrencyPair;
use App\Models\Market;
use App\Models\Plan;
use App\Models\Signal;
use App\Models\TimeFrame;
use Illuminate\Http\Request;
use App\Services\SignalService;

class SignalController extends Controller
{

    protected $signal;

    public function __construct(SignalService $signal)
    {
        $this->signal = $signal;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Manage Signals';

        $data['signals'] = Signal::when($request->type, function ($q) use ($request) {
            $q->where('is_published', ($request->type === 'draft' ? 0 : 1));
        })->whereHas('plans')->whereHas('pair')->whereHas('time')->whereHas('market')->search($request->search)->latest()->with('plans', 'pair', 'time', 'market')->paginate(Helper::pagination());

        return view('backend.signal.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Signal';

        $data['plans'] = Plan::whereStatus(true)->get();
        $data['pairs'] = CurrencyPair::whereStatus(true)->get();
        $data['times'] = TimeFrame::whereStatus(true)->get();
        $data['markets'] = Market::whereStatus(true)->get();

        return view('backend.signal.create')->with($data);
    }

    public function store(SignalRequest $request)
    {

        $isSuccess = $this->signal->create($request);

        if($isSuccess['type'] === 'success')

        return redirect()->route('admin.signals.index')->with('success', $isSuccess['message']);

    }

    public function edit($id)
    {
        $data['title'] = 'Edit Signal';

        $data['signal'] = Signal::findOrFail($id);

        $data['plans'] = Plan::whereStatus(true)->get();
        $data['pairs'] = CurrencyPair::whereStatus(true)->get();
        $data['times'] = TimeFrame::whereStatus(true)->get();
        $data['markets'] = Market::whereStatus(true)->get();

        return view('backend.signal.edit')->with($data);
    }

    public function update(SignalRequest $request, $id)
    {
       $isSuccess = $this->signal->update($request, $id);

       if($isSuccess['type'] === 'error'){
            return redirect()->back()->with('error', $isSuccess['message']);
       }

       return redirect()->back()->with('success', $isSuccess['message']);
    }

    public function destroy($id)
    {
       $isSuccess = $this->signal->destroy($id);

       if($isSuccess['type'] === 'error'){
        return redirect()->back()->with('error', $isSuccess['message']);
        }

        return redirect()->back()->with('success', $isSuccess['message']);
    }


    public function sent($id)
    {
        

        $signal = Signal::findOrFail($id);

        $signal->is_published = 1;

        $signal->save();

        $this->signal->sendSignalToUser($signal);

        return redirect()->back()->with('success', 'Successfully sent to user');
    }
}
