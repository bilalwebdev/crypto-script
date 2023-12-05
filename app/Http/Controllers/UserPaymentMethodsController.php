<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\UserPayment;
use App\Models\UserPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPaymentMethodsController extends Controller
{
    protected $p_method;
    public function __construct(UserPaymentMethod $p_method)
    {
        $this->p_method = $p_method;
    }

    public function index()
    {
        $data['title'] = "Payment Method";
        $data['p_methods'] = UserPaymentMethod::whereUserId(Auth::user()->id)->paginate(10);

        return view(Helper::theme() . 'user.payment-method.list')->with($data);
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|max:255|unique:user_payment_methods,name',
            'wallet_address' => 'required',
        ]);

        UserPaymentMethod::create([
            'name' => $request->name,
            'wallet_address' => $request->wallet_address,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Payment method created successfully');
    }


    public function update(Request $request, $id)
    {

        $method = UserPaymentMethod::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255|unique:payment_methods,name,' . $method->id,
            'wallet_address' => 'required',
        ]);

        $method->update([
            'name' => $request->name,
            'wallet_address' => $request->wallet_address,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Payment method updated successfully');
    }


    public function destroy($id)
    {
        $method = UserPaymentMethod::findOrFail($id);

        $method->delete();

        return redirect()->back()->with('success', 'Payment method Deleted successfully');
    }

    public function changeStatus($id)
    {
        $method = UserPaymentMethod::findOrFail($id);

        $method->status = !$method->status;

        $method->save();


        $notify = ['success' => 'Status Change Successfully'];

        return response()->json($notify);
    }
}
