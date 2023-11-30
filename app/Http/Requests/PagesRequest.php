<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
                'page' => 'required|unique:pages,name,'.request()->id,
                'order' => 'required|numeric|unique:pages,order,'.request()->id,
                'is_dropdown' => 'required|in:0,1',
                'keyword' => 'required|array',
                'seo_description' => 'required',
                'status' => 'required|in:0,1',
                'sections' => 'required'
            ];
        }

        return [
            'page' => 'required|unique:pages,name',
            'order' => 'required|numeric|unique:pages,order',
            'is_dropdown' => 'required|in:0,1',
            'keyword' => 'required|array',
            'seo_description' => 'required',
            'status' => 'required|in:0,1',
            'sections' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sections.required' => 'At Least One Section Should Be Selected'
        ];
    }
}
