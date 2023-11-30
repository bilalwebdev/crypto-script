<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if (request()->plan) {
            $plan = Plan::find(request()->plan);

            return [
                'plan_name' => 'required|max:255|unique:plans,name,'.$plan->id,
                'plan_type' =>'required|in:limited,unlimited',
                'price_type' =>'required|in:paid,free',
                'duration' => 'required_if:plan_type, ==, limited | numeric|gt:0',
                'price' => 'required_if:price_type,==,paid | numeric | gt:0',
                'feature.*' => 'required|max:255'
            ];
        }



        return [
            'plan_name' => 'required|unique:plans,name|max:255',
            'plan_type' => 'required|in:limited,unlimited',
            'price_type' => 'required|in:paid,free',
            'duration' => 'required_if:plan_type, ==, limited | numeric|gt:0',
            'price' => 'required_if:price_type,==,paid | numeric | gt:0',
            'feature.*' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'feature.*.required' => 'All Feature Field is Required'
        ];
    }
}
