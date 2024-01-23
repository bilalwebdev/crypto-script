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
        $commision = CommisionSetting::first();

        $allUsers = User::where('status', 1)
            // ->where('is_kyc_verified', 1)
            ->get();


        foreach ($allUsers as $user) {


            $userLts = self::checkLots($user->id);

            if ($userLts) {

                $lv1User =  $user->refferedBy;

                if (isset($lv1User)) {

                    $lvl1Lots = self::checkLots($user->id);

                    if (isset($lvl1Lots)) {
                        $commissionRate = $commision->level_1_rate;
                        $finalAmount1 = $lv1User->commision + ($commissionRate * $lvl1Lots);
                        self::updateCommision($user->id, $finalAmount1);
                    }
                }

                $lv2User = $lv1User?->refferedBy;

                if (isset($lv2User)) {
                    $lvl2Lots = self::checkLots($lv1User->id);
                    if (isset($lvl2Lots)) {
                        $commissionRate = $commision->level_2_rate;
                        $finalAmount2 = $lv2User->commision + ($commissionRate * $lvl2Lots);

                        self::updateCommision($lv2User->id, $finalAmount2);
                    }
                }


                $lv3User = $lv2User?->refferedBy;

                if (isset($lv3User)) {

                    $lvl3Lots = self::checkLots($lv2User->id);

                    if (isset($lvl3Lots)) {

                        $commissionRate = $commision->level_3_rate;
                        $finalAmount3 = $lv3User->commision + ($commissionRate * $lvl3Lots);

                        self::updateCommision($lv3User->id, $finalAmount3);
                    }
                }


                $lv4User = $lv3User?->refferedBy;
                if (isset($lv4User)) {
                    $lvl4Lots = self::checkLots($lv3User->id);

                    if (isset($lvl2Lots)) {

                        $commissionRate = $commision->level_4_rate;
                        $finalAmount4 = $lv4User->commision + ($commissionRate * $lvl4Lots);

                        self::updateCommision($lv4User->id, $finalAmount4);
                    }
                }

                if (isset($lv4User)) {
                    $lv5User = $lv4User?->refferedBy;
                    $lvl5Lots = self::checkLots($lv4User->id);

                    if (isset($lvl5Lots)) {

                        $commissionRate = $commision->level_5_rate;
                        $finalAmount5 = $lv5User->commision + ($commissionRate * $lvl5Lots);

                        self::updateCommision($lv5User->id, $finalAmount5);
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
}
