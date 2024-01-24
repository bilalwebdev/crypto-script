<?php

namespace App\Http\Controllers;

use App\Models\CommisionSetting;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function commisionCalculate()
    {
        $sponsors = [];

        $commision = CommisionSetting::first();

        $allUsers = User::where('status', 1)
            // ->where('is_kyc_verified', 1)
            ->get();


        foreach ($allUsers as $user) {

            $lv1User =  $user->refferedBy;

            if (isset($lv1User)) {



                // dd($lv1User);
                $this->processCommissionLevel($lv1User, $user, $commision, 1);
                $lv2User = $lv1User?->refferedBy;
                if (isset($lv2User)) {
                    $this->processCommissionLevel($lv2User, $user, $commision, 2);
                    $lv3User = $lv2User?->refferedBy;
                    if (isset($lv3User)) {
                        $this->processCommissionLevel($lv3User, $user, $commision, 3);
                        $lv4User = $lv3User?->refferedBy;
                        if (isset($lv4User)) {
                            $this->processCommissionLevel($lv4User, $user, $commision, 4);
                            $lv5User = $lv4User?->refferedBy;
                        }
                        if (isset($lv5User)) {
                            $this->processCommissionLevel($lv5User, $user, $commision, 5);
                        }
                    }
                }
            }
        }
        return 'commision done';
    }
    public function updateCommision($user_id, $amount)
    {

        $user = User::find($user_id);

        $user->update([
            'commision' => $amount,
        ]);
    }

    public function checkLots($user_id)
    {
        $userAllDeposits = Deposit::where('user_id', $user_id)->sum('amount');

        $userLots = intval($userAllDeposits / 1000);


        return $userLots;
    }
    private function processCommissionLevel($referrer, $currrentUser,  $commission, $level)
    {
        if ($referrer && ($lots = $this->checkLots($currrentUser->id)) !== null) {

            $commissionRateKey = "level_{$level}_rate";

            $commissionRate = $commission->$commissionRateKey;

            $finalAmount = $referrer->commision + ($commissionRate * $lots);

            $this->updateCommision($referrer->id, $finalAmount);
        }
    }
}
