<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Testimonial
{
    use Schema;

    public $has_element = true;

    public $has_content = true;

    public $image_upload_ids = ['image_one', 'image_two'];

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
            "image_two" => "Upload"
        ],

    ];

    public $classes = [
        'default' => [
            "section_header" => "col-md-6",
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6"
        ],
        'light' => [
            "section_header" => "col-md-6",
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6",
            "image_two" => "col-md-3"
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
            "color_text_for_title" => "required",
            "image_two" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];

    public $elementFields = [
        'default' => [
            "client_name" => "Text",
            "designation" => "Text",
            "description" => "Textarea",
            "image_one" => "Upload"
        ],
        'light' => [
            "client_name" => "Text",
            "designation" => "Text",
            "description" => "Textarea",
            "image_one" => "Upload"
        ]
    ];

    public $elementClasses = [
        'default' => [
            "client_name" => "col-md-6",
            "designation" => "col-md-6",
            "description" => "col-md-12",
            "image_one" => "col-md-3"
        ],
        'light' => [
            "client_name" => "col-md-6",
            "designation" => "col-md-6",
            "description" => "col-md-12",
            "image_one" => "col-md-3"
        ]
    ];

    public $elementValidation = [
        'default' => [
            "client_name" => "required",
            "designation" => "required",
            "description" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ],
        'light' => [
            "client_name" => "required",
            "designation" => "required",
            "description" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];
}
