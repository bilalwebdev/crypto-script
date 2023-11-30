<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Blog
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
            "color_text_for_title" => "Text"
        ]

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
            "blog_title" => "Text",
            "short_description" => "Textarea",
            "description" => "Summernote",
            "image_one" => "Upload",
        ],
        'light' => [
            "blog_title" => "Text",
            "short_description" => "Textarea",
            "description" => "Summernote",
            "image_one" => "Upload",
        ]
    ];

    public $elementClasses = [
        'default' => [
            "blog_title" => "col-md-12",
            "short_description" => "col-md-12",
            "description" => "col-md-12",
            "image_one" => "col-md-3",
        ],
        'light' => [
            "blog_title" => "col-md-12",
            "short_description" => "col-md-12",
            "description" => "col-md-12",
            "image_one" => "col-md-3",
        ]
    ];

    public $elementValidation = [
        'default' => [
            "blog_title" => "required",
            "short_description" => "required",
            "description" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ],
        'light' => [
            "blog_title" => "required",
            "short_description" => "required",
            "description" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];
}
