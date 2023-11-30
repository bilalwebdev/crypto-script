<?php

namespace App\Utility\Sections;
use App\Utility\Schema;

class Benefits
{
    use Schema;

    public $has_element = true;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            'section_header' => 'Text',
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'image_one' => 'Upload',
        ],
        'light' => [
            'section_header' => 'Text',
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'image_one' => 'Upload',
        ]
    ];

    public $classes = [
        'default' => [
            'section_header' => 'col-md-6',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-12',
            'image_one' => 'col-md-3',
        ],
        'light' => [
            'section_header' => 'col-md-6',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-12',
            'image_one' => 'col-md-3',
        ]
    ];

    public $validation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'section_header' => 'required',
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'section_header' => 'required',
        ]
    ];

    public $elementFields = [
        'default' => [
            'title' => 'Text',
            'icon' => 'Icon',
            'description' => 'Textarea',
            'image_one' => 'Upload',
        ],
        'light' => [
            'title' => 'Text',
            'description' => 'Textarea',
            'image_one' => 'Upload',
        ]
    ];

    public $elementClasses = [
        'default' => [
            'image_one' => 'col-md-3',
            'title' => 'col-md-6',
            'icon' => 'col-md-6',
            'description' => 'col-md-12'
        ],
        'light' => [
            'image_one' => 'col-md-3',
            'title' => 'col-md-6',
            'description' => 'col-md-12'
        ]
    ];

    public $elementValidation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required'
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'description' => 'required'
        ]
    ];
}