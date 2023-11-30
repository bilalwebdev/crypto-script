<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Banner
{
    use Schema;

    public $has_element = false;
    public $has_content = true;

    public $image_upload_ids = ['image_one', 'image_two', 'image_three'];

    public $fields = [
        'default' => [
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'button_text' => 'Text',
            'button_text_link' => 'Text',
            'repeater' => 'Repeater',
            'image_one' => 'Upload',
            'image_two' => 'Upload',
        ],
        'light' => [
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'button_text' => 'Text',
            'button_text_link' => 'Text',
            'button_two_text' => 'Text',
            'button_two_text_link' => 'Text',
            "description" => "Textarea",
            'image_one' => 'Upload',
            'image_two' => 'Upload',
            'image_three' => 'Upload',
        ],

    ];

    public $classes = [
        'default' => [
            'image_one' => 'col-md-3',
            'image_two' => 'col-md-3',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-6',
            'button_text' => 'col-md-6',
            'button_text_link' => 'col-md-6'
        ],
        'light' => [
            'image_one' => 'col-md-3',
            'image_two' => 'col-md-3',
            'image_three' => 'col-md-3',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-6',
            'description' => 'col-md-12',
            'button_text' => 'col-md-6',
            'button_text_link' => 'col-md-6',
            'button_two_text' => 'col-md-6',
            'button_two_text_link' => 'col-md-6'
        ],

    ];

    public $validation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "image_two" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'button_text' => 'required',
            'button_text_link' => 'required',
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "image_two" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "image_three" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_text_link' => 'required',
            'button_two_text' => 'required',
            'button_two_text_link' => 'required',
        ],

    ];
}
