<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\Plan;
use App\Services\UserPlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    protected $planservice;

    public function __construct(UserPlanService $planservice)
    {
        $this->planservice = $planservice;
    }

    public function plans()
    {
        $data['title'] = 'Plans';

        $data['plans'] = Plan::whereStatus(true)->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.plans')->with($data);
    }

    public function subscribe(Request $request)
    {
        $isSuccess = $this->planservice->subscribe($request);

        if ($isSuccess['type'] == 'error') {
            return redirect()->back()->with('error', $isSuccess['message']);
        }

        if ($isSuccess['type'] == 'redirect') {
            return redirect()->to($isSuccess['message']);
        }
        
        return redirect()->back()->with('success', $isSuccess['message']);
    }
}
