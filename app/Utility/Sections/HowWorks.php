<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class HowWorks
{
    use Schema;
    public $has_element = true;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            "section_header" => "Text",
            "title" =>  "Text",
            "color_text_for_title" => "Text"
        ],
        'light' => [
            "section_header" => "Text",
            "title" =>  "Text",
            "color_text_for_title" => "Text",
        ]

    ];

    public $classes = [
        'default' => [
            "section_header" => "col-md-6",
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6"
        ],
        'light' => [
            "section_header" => "col-md-12",
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6"
        ]
    ];

    public $validation = [
        'default' => [
            "section_header" => "required",
            "title" =>  "required",
            "color_text_for_title" => "required"
        ],
        'light' => [
            "section_header" => "required",
            "title" =>  "required",
            "color_text_for_title" => "required"
        ]
    ];

    public $elementFields = [
        'default' => [
            "title" => "Text",
            "description" => "Textarea"
        ],
        'light' => [
            'image_one' => 'Upload',
            "title" => "Text",
            "description" => "Textarea"
        ]
    ];

    public $elementClasses = [
        'default' => [
            "title" => "col-md-12",
            "description" => "col-md-12"
        ],
        'light' => [
            'image_one' => 'col-md-3',
            "title" => "col-md-12",
            "description" => "col-md-12"
        ]
    ];

    public $elementValidation = [
        'default' => [
            "title" => "required",
            "description" => "required"
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            "title" => "required",
            "description" => "required"
        ]
    ];
}
