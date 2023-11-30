<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignalRequest extends FormRequest
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

        return [
            'title' => 'required|max:255',
            'plans' => 'required',
            'currency_pair' => 'required|exists:currency_pairs,id',
            'time_frame' => 'required|exists:time_frames,id',
            'open_price' => 'required|numeric',
            'sl' => 'required|numeric',
            'tp' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'direction' => 'required|in:buy,sell',
            'market' => 'required|exists:markets,id'
        ];
    }

    public function messages()
    {
        return [
            'sl.required' => 'Stop Loss Field is required',
            'tp.required' => 'Take Profit Field is required'
        ];
    }
}
