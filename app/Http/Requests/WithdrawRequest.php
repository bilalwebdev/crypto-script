<?php

namespace App\Http\Requests;

use App\Models\WithdrawGateway;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
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

        $method = WithdrawGateway::find(request()->id);

        if($method){

            return [
                'name' => 'required|unique:withdraw_gateways,name,' . $method->id,
                'min_amount' => 'required|numeric|min:0',
                'max_amount' => 'required|numeric|gt:min_amount',
                'charge_type' => 'required|in:fixed,percent',
                'charge' => 'required|numeric',
                'status' => 'required|in:0,1',
                'withdraw_instruction' => 'sometimes'
            ];
        }

        return [
            'name' => 'required|unique:withdraw_gateways,name',
            'min_amount' => 'required|numeric|gt:0',
            'max_amount' => 'required|numeric|gt:min_amount',
            'charge_type' => 'required|in:fixed,percent',
            'charge' => 'required|numeric',
            'status' => 'required|in:0,1',
            'withdraw_instruction' => 'sometimes'
        ];
    }
}
