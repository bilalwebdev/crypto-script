<?php

namespace App\Http\Requests;

use App\Helpers\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class AdminForgotPasswordRequest extends FormRequest
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
        if (request()->code) {
            return [
                'code' => 'required',
                'g-recaptcha-response' => Rule::requiredIf(Helper::config()->allow_recaptcha == 1)
            ];
        }
        return [
            'email' => 'required|email',
            'g-recaptcha-response' => Rule::requiredIf(Helper::config()->allow_recaptcha == 1)
        ];
    }

    public function message()
    {
        return [
            'g-recaptcha-response.required' => 'You Have To fill recaptcha'
        ];
    }
}
