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
            ->where('is_kyc_verified', 1)
            ->get();

        foreach ($allUsers as $user) {

            $reffers =  $user->refferals;

            $finalAmount = $user->commision;

            if (isset($reffers)) {

                $sponsor = $user->refferedBy;


                foreach ($reffers as $key => $ref) {

                    $commissionLevel = $key + 1; // Adjust this based on your user model structure

                    $userAllDeposits = Deposit::where('user_id', $ref->id)->sum('amount');

                    $userLots = intval($userAllDeposits / 1000);


                    if (isset($userLots)) {



                        if ($commissionLevel == 1) {
                            $commissionRate = $commision->level_1_rate;

                            $finalAmount = $finalAmount + ($commissionRate * $userLots);
                        }


                        if ($commissionLevel == 2) {
                            $commissionRate = $commision->level_2_rate;

                            $finalAmount = $finalAmount + ($commissionRate * $userLots);
                        }


                        if ($commissionLevel == 3) {
                            $commissionRate = $commision->level_3_rate;

                            $finalAmount = $finalAmount + ($commissionRate * $userLots);
                        }

                        if ($commissionLevel == 4) {
                            $commissionRate = $commision->level_4_rate;

                            $finalAmount = $finalAmount + ($commissionRate * $userLots);
                        }

                        if ($commissionLevel == 5) {
                            $commissionRate = $commision->level_5_rate;

                            $finalAmount = $finalAmount + ($commissionRate * $userLots);
                        }
                    }
                }


                $user->update([
                    'commision' => $finalAmount,
                ]);
            }
        }
    }

    // public function updateCommision($user_id, $amount)
    // {

    //     $user = User::find($user_id);

    //     $user->update([
    //         'commision' => $amount,
    //     ]);
    // }
}
