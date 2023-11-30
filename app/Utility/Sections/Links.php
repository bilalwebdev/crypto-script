<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Links
{
    use Schema;

    public $has_element = true;

    public $has_content = false;

    public $image_upload_ids = [];

    public $elementFields = [
        'default' => [
            "page_title" => "Text",
            "description" => "Summernote"
        ],
        'light' => [
            "page_title" => "Text",
            "description" => "Summernote"
        ]
    ];

    public $elementClasses = [
        'default' => [
            "page_title" => "col-md-12",
            "description" => "col-md-12"
        ],
        'light' => [
            "page_title" => "col-md-12",
            "description" => "col-md-12"
        ]
    ];

    public $elementValidation = [
        'default' => [
            "page_title" => "required",
            "description" => "required"
        ],
        'light' => [
            "page_title" => "required",
            "description" => "required"
        ]
    ];

}
