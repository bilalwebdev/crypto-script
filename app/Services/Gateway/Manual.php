<?php

namespace App\Services\Gateway;

use App\Helpers\Helper\Helper;
use App\Models\Admin;
use App\Notifications\DepositNotification;

class Manual
{
    public static function process($request, $gateway, $amount, $deposit)
    {
        $validation = [];
        if ($gateway->parameter->user_proof_param != null) {
            foreach ($gateway->parameter->user_proof_param as $params) {

                $params = (array) $params;


                if ($params['type'] == 'text' || $params['type'] == 'textarea') {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = $params['validation'] == 'required' ? 'required' : 'sometimes';

                    $validation[$key] = $validationRules;
                } else {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = ($params['validation'] == 'required' ? 'required' : 'sometimes') . "|image|mimes:jpg,png,jpeg|max:2048";

                    $validation[$key] = $validationRules;
                }
            }
        }

        $data = $request->validate($validation);


        foreach ($data as $key => $upload) {

            if ($request->hasFile($key)) {

                $filename = Helper::saveImage($upload, Helper::filePath('manual_payment'));

                $data[$key] = ['file' => $filename, 'type' => 'file'];
            }
        }


        $deposit->payment_proof = $data;

        $deposit->type = 0;

        $deposit->status = 2;

        $deposit->save();

        session()->put('manual', 'yes');

        $admin = Admin::where('type', 'super')->first();

        $type = session('type');

       
        $admin->notify(new DepositNotification($deposit, 'offline', $type));
       
      


        return ['type' => 'success', 'message' => ''];
    }
}
