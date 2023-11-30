<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\RefferedCommission;
use App\Models\User;
use Carbon\Carbon;

class ReferralController extends Controller
{
    public function index()
    {
        $data['title'] = 'Manage Referral';

        $data['invest_referral'] = Referral::where('type','invest')->latest()->first();
        $data['interest_referral'] = Referral::where('type','interest')->latest()->first();

        return view('backend.referral.index')->with($data);
    }

    public function investStore(Request $request)
    {

        $refferal = Referral::where('type', $request->type)->first();

        if(!$refferal){
            $refferal = new Referral();
        }

        $refferal->level = $request->level;
        $refferal->commission = $request->commision;

        $refferal->type = $request->type;

        $refferal->save();

        return redirect()->back()->with('success', 'Refferal Level Updated Successfully');
    }


    public function refferalStatusChange(Request $request)
    {
        $refferal = Referral::findOrFail($request->id);

        if ($request->status) {
            $refferal->status = false;
        } else {
            $refferal->status = true;
        }

        $refferal->save();

        $notify = ['success' => 'Plan Status Change Successfully'];

        return response($notify);
    }

    
}
