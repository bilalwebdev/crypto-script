<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            $language = Language::find(request()->id);

            return [
                'language' => 'required|unique:languages,name,' . $language->id,
                'code' => 'required|unique:languages,code,' . $language->id,
            ];
            
        }


        return [
            'language' => 'required|unique:languages,name',
            'code' => 'required|unique:languages,code',
        ];
    }
}
