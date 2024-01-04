<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    //

    public function index(Request $request)
    {

        $data['title'] = 'Manage Payment Methods';
        $data['payment_methods'] = PaymentMethod::search($request->search)
            ->latest()->paginate(Helper::pagination());

        return view('backend.payment-methods.index')->with($data);
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:payment_methods,name',
            'wallet_address' => 'required',
            'min_amount' => 'required',
            'user_id' => Auth::id(),
            'status' => 'required|in:0,1'
        ]);

        PaymentMethod::create($data);

        return redirect()->back()->with('success', 'Payment method created successfully');
    }

    public function update(Request $request, $id)
    {

        $method = PaymentMethod::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:payment_methods,name,' . $method->id,
            'wallet_address' => 'required',
            'min_amount' => 'required',
            'user_id' => Auth::id(),
            'status' => 'required|in:0,1'
        ]);

        $method->update($data);

        return redirect()->back()->with('success', 'Payment method updated successfully');
    }

    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);

        $method->delete();

        return redirect()->back()->with('success', 'Payment method Deleted successfully');
    }

    public function changeStatus($id)
    {
        $method = PaymentMethod::findOrFail($id);

        if ($method->status) {

            $method->status = false;
        } else {

            $method->status = true;
        }

        $method->save();


        $notify = ['success' => 'Status Change Successfully'];

        return response()->json($notify);
    }
}
