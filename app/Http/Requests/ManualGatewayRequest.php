<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManualGatewayRequest extends FormRequest
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

        if (request()->id) {
            return [
                "name" => 'required',
                "user_proof_param" => 'sometimes|array',
                'image' => 'image|mimes:jpg,png,jpeg',
                'rate' => 'required|numeric',
                'charge' => 'required|numeric',
                'gateway_currency' => 'required',
                'gateway_type' => 'required|in:crypto,bank',
                'qr_code' => 'image|mimes:jpg,png,jpeg'
            ];
        }

        return [
            "name" => 'required',
            "user_proof_param" => 'sometimes|array',
            'image' => 'image|mimes:jpg,png,jpeg',
            'rate' => 'required|numeric',
            'charge' => 'required|numeric',
            'gateway_currency' => 'required',
            'gateway_type' => 'required|in:crypto,bank',
            'qr_code' => 'required_if:gateway_type,==,crypto|image|mimes:jpg,png,jpeg'
        ];
    }
}
