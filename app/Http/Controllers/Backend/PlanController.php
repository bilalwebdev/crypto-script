<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper\Helper;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Services\PlanService;

class PlanController extends Controller
{
    protected $plan;

    public function __construct(PlanService $plan)
    {
        $this->plan = $plan;
    }

    public function index(Request $request)
    {
        $data['title'] = 'All Plans';

        $data['plans'] = Plan::search($request->search)->orderBy('id','ASC')->paginate(Helper::pagination());

        return view('backend.plan.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Plan';

        return view('backend.plan.create')->with($data);
    }

    public function store(PlanRequest $request)
    {
        $this->plan->createPlan($request);

        return redirect()->route('admin.plan.index')->with('success', 'Plan Created Successfully');
    }


    public function edit(Plan $plan)
    {
        $title = 'Edit Plan';

        return view('backend.plan.edit', compact('title', 'plan'));
    }

    public function update(PlanRequest $request)
    {
        $isSuccess = $this->plan->updatePlan($request);

        if ($isSuccess['type'] === 'error') {
            return redirect()->back()->with('error', $isSuccess['message']);
        }

        return redirect()->route('admin.plan.index')->with('success', 'Plan Updated Successfully');
    }




    public function planStatusChange($id)
    {
        $isSuccess = $this->plan->changeStatus($id);

        if ($isSuccess['type'] === 'success')

            return response()->json(['success' =>  $isSuccess['message']]);
    }
}
