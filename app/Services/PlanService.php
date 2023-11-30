<?php

namespace App\Services;

use App\Models\Plan;

use Illuminate\Support\Str;

class PlanService
{
    public function createPlan($request)
    {
        Plan::create([
            'name' => $request->plan_name,
            'slug' => Str::slug($request->plan_name),
            'plan_type' => $request->plan_type,
            'price_type' => $request->price_type,
            'price' => $request->price,
            'duration' => $request->duration,
            'feature' => $request->feature,
            'status' => 1,
            'whatsapp' => $request->whatsapp === 'on' ? 1 : 0,
            'telegram' => $request->telegram === 'on' ? 1 : 0,
            'email' => $request->email === 'on' ? 1 : 0,
            'sms' => $request->sms === 'on' ? 1 : 0,
            'dashboard' => $request->dashboard === 'on' ? 1 : 0,
        ]);
    }

    public function updatePlan($request)
    {
        $plan = Plan::find($request->plan);

        if (!$plan) {
            return ['type' => 'error', 'message' => 'Plan Not Found'];
        }

        $plan->update([
            'name' => $request->plan_name,
            'slug' => Str::slug($request->plan_name),
            'plan_type' => $request->plan_type,
            'price_type' => $request->price_type,
            'price' => $request->price,
            'duration' => $request->duration,
            'feature' => $request->feature,
            'whatsapp' => $request->whatsapp === 'on' ? 1 : 0,
            'telegram' => $request->telegram === 'on' ? 1 : 0,
            'email' => $request->email === 'on' ? 1 : 0,
            'sms' => $request->sms === 'on' ? 1 : 0,
            'dashboard' => $request->dashboard === 'on' ? 1 : 0,
        ]);


        return ['type' => 'success', 'message' => 'Plan Updated Successfully'];
    }

    public function changeStatus($id)
    {
        $plan = Plan::findOrFail($id);

        if ($plan->status) {

            $plan->status = false;
        } else {

            $plan->status = true;
        }

        $plan->save();


        return ['type'=> 'success', 'message'=> 'Plan Status Change Successfully'];
    }
}
