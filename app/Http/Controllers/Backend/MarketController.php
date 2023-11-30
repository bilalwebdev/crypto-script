<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Manage Market Type';

        $data['markets'] = Market::search($request->search)->latest()->paginate( Helper::pagination());

        return view('backend.market.index')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:markets,name|max:255',
            'status' => 'required|in:0,1'
        ]);

        Market::create($data);

        return redirect()->back()->with('success', 'Market Type created successfully');
    }

    public function update(Request $request, $id)
    {

        $pair = Market::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:markets,name,' . $pair->id,
            'status' => 'required|in:0,1'
        ]);

        $pair->update($data);

        return redirect()->back()->with('success', 'Market Type updated successfully');
    }

    public function destroy($id)
    {
        $pair = Market::findOrFail($id);

        $pair->delete();

        return redirect()->back()->with('success', 'Market Type Deleted successfully');
    }

    public function changeStatus($id)
    {
        $pair = Market::findOrFail($id);

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
