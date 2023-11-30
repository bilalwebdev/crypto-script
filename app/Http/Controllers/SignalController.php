<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\DashboardSignal;
use App\Models\Signal;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function allSignals(Request $request)
    {
        $data['title'] = 'All Signals';

        $dashboardSignal = DashboardSignal::where('user_id', auth()->id())->pluck('signal_id');

        $data['signals'] = Signal::when($request->search, function ($item) use ($request) {
            $item->where(function ($item) use ($request) {
                $item->where('id', $request->search)
                    ->orWhere('title', 'LIKE', '%' . $request->search . '%');
            });
        })->whereIn('id', $dashboardSignal)->latest()->with('plans', 'pair', 'time', 'market')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.signals')->with($data);
    }

    public function details($id)
    {
        $data['signal'] = Signal::findOrFail($id);

        $data['title'] = 'Signal Description';

        return view(Helper::theme(). 'user.signal_details')->with($data);
    }
}
