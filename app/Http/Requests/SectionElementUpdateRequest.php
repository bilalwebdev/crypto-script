<?php

namespace App\Http\Requests;

use App\Helpers\Helper\Helper;
use App\Utility\FormBuilder;
use Illuminate\Foundation\Http\FormRequest;

class SectionElementUpdateRequest extends FormRequest
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
        $activeTheme = Helper::config()->theme;

        return FormBuilder::classMap(request()->name)->elementValidation[$activeTheme];
    }
}
