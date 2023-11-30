<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class About
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = ['image_one', 'image_two'];

    public $fields = [
        'default' => [
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'button_text' => 'Text',
            'button_link' => 'Text',
            'repeater' => 'Repeater',
            'description' => 'Textarea',
            'image_one' => 'Upload',
            'image_two' => 'Upload',
        ],
        'light' => [
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'button_text' => 'Text',
            'button_link' => 'Text',
            'repeater' => 'Repeater',
            'description' => 'Textarea',
            'image_one' => 'Upload',
            'image_two' => 'Upload',
        ]

    ];

    public $classes = [
        'default' => [
            'image_one' => 'col-md-3',
            'image_two' => 'col-md-3',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-6',
            'button_text' => 'col-md-6',
            'button_link' => 'col-md-6',
            'description' => 'col-md-12',
        ],
        'light' => [
            'image_one' => 'col-md-3',
            'image_two' => 'col-md-3',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-6',
            'button_text' => 'col-md-6',
            'button_link' => 'col-md-6',
            'description' => 'col-md-12',
        ]
    ];

    public $validation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "image_two" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
            'description' => 'required'
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "image_two" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
            'description' => 'required'
        ]
    ];
}
