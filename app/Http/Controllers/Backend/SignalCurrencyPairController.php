<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\CurrencyPair;
use Illuminate\Http\Request;

class SignalCurrencyPairController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Manage Currency pair';

        $data['pairs'] = CurrencyPair::search($request->search)->latest()->paginate(Helper::pagination());

        return view('backend.currency_pair.index')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:currency_pairs,name',
            'status' => 'required|in:0,1'
        ]);

        CurrencyPair::create($data);

        return redirect()->back()->with('success', 'Currency pair created successfully');
    }

    public function update(Request $request, $id)
    {

        $pair = CurrencyPair::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:currency_pairs,name,' . $pair->id,
            'status' => 'required|in:0,1'
        ]);

        $pair->update($data);

        return redirect()->back()->with('success', 'Currency pair updated successfully');
    }

    public function destroy($id)
    {
        $pair = CurrencyPair::findOrFail($id);
        
        $pair->delete();

        return redirect()->back()->with('success', 'Currency pair Deleted successfully');
    }

    public function changeStatus($id)
    {
        $pair = CurrencyPair::findOrFail($id);

        if ($pair->status) {

            $pair->status = false;
        } else {

            $pair->status = true;
        }

        $pair->save();


        $notify = ['success' => 'Status Change Successfully'];

        return response()->json($notify);
    }
}
