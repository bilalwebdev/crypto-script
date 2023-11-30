<?php

namespace App\Http\Requests;

use App\Models\Configuration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigurationRequest extends FormRequest
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


        $type = request()->type;

        $general = Configuration::first();

        if ($type === 'general') {
            return [
                'sitename' => 'required',
                'signup_bonus' => 'gte:0',
                'withdraw_limit' => 'integer',
                'trans_type' => 'required|in:fixed,percent',
                'trans_limit' => 'required|numeric',
                'trans_charge' => 'required|numeric',
                'min_amount' => 'required|numeric',
                'max_amount' => 'required|numeric',

                'alert' => 'required|in:izi,toast,sweet',
                'site_currency' => 'required|max:10',
                'pagination_limit' => 'numeric|gt:0',
                'logo' => [Rule::requiredIf(function () use ($general) {
                    return $general == null;
                }), 'image', 'mimes:jpg,png,jpeg'],
                'icon' => [Rule::requiredIf(function () use ($general) {
                    return $general == null;
                }), 'image', 'mimes:jpg,png,jpeg'],
            ];
        } elseif ($type === 'api') {

            return [
                'recaptcha_key' => 'required_if:allow_recaptcha,==,on',
                'recaptcha_secret' => 'required_if:allow_recaptcha,==,on',
                'twak_key' => 'required_if:twak_allow,==,on',
                'analytics_key' => 'required_if:analytics_status,==,on',
                'bot_url' => 'required_if:allow_telegram,==,on',
                'telegram_token' => 'required_if:allow_telegram,==,on',
                'app_id' => 'required_if:allow_facebook,==,on',
                'app_secret' => 'required_if:allow_facebook,==,on',
                'google_app_id' => 'required_if:allow_google,==,on',
                'google_app_secret' => 'required_if:allow_google,==,on',
            ];
        } elseif ($type === 'kyc') {
            return  [
                "kyc" => 'required|array',
            ];
        } elseif ($type === 'others') {
            return [
                'button_text' => 'required_if:allow_modal,==,on',
                'cookie_text' => 'required_if:allow_modal,==,on',
                'seo_description' => 'max:2000',
                'copyright' => 'required|max:255'
            ];
        }else{
            return [];
        }
    }
}
