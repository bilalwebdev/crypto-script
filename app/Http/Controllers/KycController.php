<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\GeneralSetting;
use App\Notifications\KycUpdateNotification;
use Illuminate\Http\Request;

class KycController extends Controller
{

    public function kyc()
    {
        if (auth()->user()->kyc == 1) {
            return redirect()->route('user.dashboard')->with('success', 'Your Kyc Verification Successfull');
        }
        $data['title'] = 'Kyc Verification';
        return view(Helper::theme(). 'user.kyc')->with($data);
    }


    public function kycUpdate(Request $request)
    {
        $general = Configuration::first();

        $user = auth()->user();

        if ($user->kyc == 2) {
            return redirect()->back()->with('error', 'You have already submitted KYC form');
        }


        $validation = [];
        if ($general->kyc != null) {
            foreach ($general->kyc as $params) {
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

                $filename = Helper::saveImage($upload, Helper::filePath('user'));

                $data[$key] = ['file' => $filename, 'type' => 'file'];
            }
        }

        $user->kyc_information = $data;

        $user->is_kyc_verified = 2;

        $user->save();

        $admin = Admin::where('type','super')->first();

        $admin->notify(new KycUpdateNotification($user));


        return back()->with('success', 'Successfully send Kyc Information to Admin');
    }
}
