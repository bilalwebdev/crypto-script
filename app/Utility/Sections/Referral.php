<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Referral
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            "section_header" => "Text",
            "title" =>  "Text",
            "color_text_for_title" => "Text"
        ],
        'light' => [
            "title" =>  "Text",
            "color_text_for_title" => "Text",
            "description" => "Textarea",
            "image_one" => "Upload",
        ]

    ];

    public $classes = [
        'default' => [
            "section_header" => "col-md-6",
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6"
        ],
        'light' => [
            "title" =>  "col-md-6",
            "color_text_for_title" => "col-md-6",
            "description" => "col-md-12",
            'image_one' => 'col-md-3',
        ]
    ];

    public $validation = [
        'default' => [
            "section_header" => "required",
            "title" =>  "required",
            "color_text_for_title" => "required"
        ],
        'light' => [
            "title" =>  "required",
            "color_text_for_title" => "required",
            "description" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];

}
