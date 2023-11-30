<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\Gateway;
use Illuminate\Support\Str;

class ManualGatewayService
{

    public function updateOnlineGateway($request, $gateway)
    {
        if ($request->hasFile('image')) {
            $filename = Helper::saveImage($request->image, Helper::filePath('gateways'), '', $gateway->image);
        }

        $gateway->update([
            'image' => $filename ?? $gateway->image,
            'parameter' => $request->parameter,
            'rate' => $request->rate
        ]);

        return ['type' => 'success', 'message' => 'Gateway Updated Successfully'];
    }


    public function createMethod($request)
    {
        $gatewayParameters = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'routing_number' => $request->routing_number,
            'branch_name' => $request->branch_name,
            'gateway_currency' => $request->gateway_currency,
            'gateway_type' => $request->gateway_type,
            'qr_code' => '',
            'payment_instruction' => $request->payment_instruction,
            'user_proof_param' => array_values($request->user_proof_param ?? []),
        ];


        if ($request->hasFile('image')) {
            $filename = Helper::saveImage($request->image, Helper::filePath('gateways'));
        }

        if ($request->hasFile('qr_code')) {
            $gatewayParameters['qr_code'] = Helper::saveImage($request->qr_code, Helper::filePath('gateways'));
        }


        Gateway::create([
            'name' => Str::slug($request->name),
            'image' => $filename ?? '',
            'parameter' => $gatewayParameters,
            'type' => 0,
            'rate' => $request->rate,
            'charge' => $request->charge
        ]);


        return ['type' => 'success', 'message' => 'Gateway Created Successfully'];
    }


    public function updateMethod($request, $gateway)
    {
        $gatewayParameters = [
            'name' => $request->name,
            'account_number' => $request->account_number,
            'routing_number' => $request->routing_number,
            'branch_name' => $request->branch_name,
            'gateway_currency' => $request->gateway_currency,
            'gateway_type' => $request->gateway_type,
            'qr_code' => $gateway->parameter->gateway_type == 'crypto' ? $gateway->parameter->qr_code : '',
            'payment_instruction' => $request->payment_instruction,
            'user_proof_param' => array_values($request->user_proof_param ?? []),
        ];

        if ($request->hasFile('image')) {
            $filename = Helper::saveImage($request->image, Helper::filePath('gateways'), '', $gateway->image);
        }

        if ($request->hasFile('qr_code')) {
            $gatewayParameters['qr_code'] = Helper::saveImage($request->qr_code, Helper::filePath('gateways'), '', $gateway->parameter->qr_code);
        }

        $gateway->update([
            'name' => Str::slug($request->name),
            'image' => $filename ?? $gateway->image,
            'parameter' => $gatewayParameters,
            'rate' => $request->rate,
            'charge' => $request->charge,

        ]);

        return ['type' => 'success', 'message' => 'Gateway Updated Successfully'];
    }
}
