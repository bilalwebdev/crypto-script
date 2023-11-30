<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManualGatewayRequest;
use App\Models\{
    Admin,
    Configuration,
    Deposit,
    Gateway,
    GeneralSetting,
    Payment,
    PlanSubscription,
    Transaction,
    User
};
use App\Notifications\PlanSubscriptionNotification;
use App\Services\ManualGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ManageGatewayController extends Controller
{
    protected $gateway;

    public function __construct(ManualGatewayService $gateway)
    {
        $this->gateway = $gateway;
    }


    public function online()
    {
        $data['title'] = 'Online payment gateways';

        $data['gateways'] = Gateway::where('type', true)->latest()->get();

        return view('backend.gateway.index')->with($data);
    }


    public function offline()
    {
        $data['title'] = 'Offline payment gateways';

        $data['gateways'] = Gateway::where('type', false)->latest()->get();

        return view('backend.gateway.index')->with($data);
    }

    public function loadView($view)
    {
        $data['title'] = ucfirst($view) . ' Payment';

        $data['gateway'] = Gateway::where('name', $view)->first();

        if (str_contains($view, 'gourl')) {

            $data['title'] = 'GoUrl Payment';

            $data['currency'] = config('laravel-crypto-payment-gateway.paymentbox');

            $data['gateways'] = Gateway::where('name', 'LIKE', '%' . 'gourl' . '%')->get();

            return view('backend.gateway.gourl')->with($data);
        }

        $loadView = 'backend.gateway.' . $view;

        return view($loadView)->with($data);
    }

    public function status($id)
    {
        $gateway = Gateway::find($id);

        if (!$gateway) {
            return response()->json(['success' => false]);
        }

        $gateway->status = !$gateway->status;

        $gateway->save();

        return response()->json(['success' => true]);
    }


    public function updateOnlinePaymentGateway(Request $request, $id)
    {
        $gateway = Gateway::findOrFail($id);

        $request->validate([
            "parameter.*" => 'required',
            'image' => [Rule::requiredIf(function () use ($gateway) {
                return $gateway == null;
            }), 'image', 'mimes:jpg,png,jpeg'],
            'rate' => 'required|numeric',
        ]);

        $isSuccess = $this->gateway->updateOnlineGateway($request, $gateway);

        if ($isSuccess['type'] == 'success')
            return redirect()->back()->with('success', 'Gateway Updated Successfully');
    }

    public function gourlUpdate(Request $request)
    {

        $request->validate([
            'parameter' => 'required|array',
            'parameter.*.gateway_currency' => 'required',
            'parameter.*.public_key' => 'required',
            'parameter.*.private_key' => 'required',
            'parameter.*.rate' => 'required|gt:0',
            'parameter.*.gourl_image' => 'sometimes|mimes:jpg,png,jpeg',
            'status' => 'parameter.*.required'
        ]);


        foreach ($request->parameter as $key =>  $params) {




            $gatewayName = 'gourl_' . $key;


            $gateway = Gateway::where('name', $gatewayName)->first();


            if ($gateway) {

                if (isset($params['image'])) {

                    $image = Helper::saveImage($params['image'], Helper::filePath('gateways'), '200x200', $gateway->image);
                } else {
                    $image = $gateway->image;
                }

                $gatewayParameters = [
                    'gateway_currency' => $params['gateway_currency'],
                    'public_key' => $params['public_key'],
                    'private_key' => $params['private_key'],
                ];
            } else {
                $gateway = new Gateway();

                $gatewayParameters = [
                    'gateway_currency' => $params['gateway_currency'],
                    'public_key' => $params['public_key'],
                    'private_key' => $params['private_key'],
                ];
                $image = Helper::saveImage($params['image'], Helper::filePath('gateways'));
            }



            $gateway->name = $gatewayName;
            $gateway->image = $image;
            $gateway->parameter = $gatewayParameters;
            $gateway->rate = $params['rate'];

            $gateway->type = 1;

            $gateway->save();


            Helper::setEnv([
                strtoupper($gatewayName) . '_PUBLIC_KEY' => $gatewayParameters['public_key'],
                strtoupper($gatewayName) . '_PRIVATE_KEY' => $gatewayParameters['private_key'],
            ]);
        }
        return redirect()->back()->with('success', 'Gateway Updated Successfully');
    }



    public function offlineCreate()
    {
        $data['title'] = 'Create Gateway';

        return view('backend.gateway.create_bank')->with($data);
    }


    public function offlineStore(ManualGatewayRequest $request)
    {
        $isSuccess = $this->gateway->createMethod($request);

        if ($isSuccess['type'] == 'success') {
            return redirect()->back()->with('success', $isSuccess['message']);
        }
    }


    public function offlineEdit($id)
    {
        $data['title'] = 'Offline Payment Gateway';

        $data['gateway'] = Gateway::findOrFail($id);

        return view('backend.gateway.bank')->with($data);
    }

    public function offlineUpdate(ManualGatewayRequest $request, $id)
    {

        $gateway = Gateway::findOrFail($id);

        if ($this->gateway->updateMethod($request, $gateway)['type'] == 'success')
            return redirect()->back()->with('success', "Payment Gateway Setting Updated Successfully");
    }
}
