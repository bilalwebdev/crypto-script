<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Contact
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = [];

    public $fields = [
        'default' => [
            "section_header" => "Text",
            "title" => "Text",
            "color_text_for_title" => "Text",
            "email" => "Text",
            "phone" => "Text",
            "address" => "Text",
            "form_header" => "Text",
            "color_text_for_form_header" => "Text"
        ],
        'light' => [
            "section_header" => "Text",
            "title" => "Text",
            "color_text_for_title" => "Text",
            "email" => "Text",
            "phone" => "Text",
            "address" => "Text",
            "form_header" => "Text",
            "color_text_for_form_header" => "Text"
        ]
    ];

    public $classes = [
        'default' => [
            "section_header" => "col-md-6",
            "title" => "col-md-6",
            "color_text_for_title" => "col-md-6",
            "email" => "col-md-6",
            "phone" => "col-md-6",
            "address" => "col-md-6",
            "form_header" => "col-md-6",
            "color_text_for_form_header" => "col-md-6"
        ],
        'light' => [
            "section_header" => "col-md-6",
            "title" => "col-md-6",
            "color_text_for_title" => "col-md-6",
            "email" => "col-md-6",
            "phone" => "col-md-6",
            "address" => "col-md-6",
            "form_header" => "col-md-6",
            "color_text_for_form_header" => "col-md-6"
        ]
    ];

    public $validation = [
        'default' => [
            "section_header" => "required",
            "title" => "required",
            "color_text_for_title" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "form_header" => "required",
            "color_text_for_form_header" => "required"
        ],
        'light' => [
            "section_header" => "required",
            "title" => "required",
            "color_text_for_title" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "form_header" => "required",
            "color_text_for_form_header" => "required"
        ]
    ];

}
