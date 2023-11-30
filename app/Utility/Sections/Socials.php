<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Socials
{
    use Schema;

    public $has_element = true;

    public $has_content = false;

    public $image_upload_ids = [];

    public $elementFields = [
        'default' => [
            "icon" => "Icon",
            "link" => "Text"
        ],
        'light' => [
            "icon" => "Icon",
            "link" => "Text"
        ]
    ];

    public $elementClasses = [
        'default' => [
            "icon" => "col-md-6",
            "link" => "col-md-6"
        ],
        'light' => [
            "icon" => "col-md-6",
            "link" => "col-md-6"
        ]
    ];

    public $elementValidation = [
        'default' => [
            "icon" => "required",
            "link" => "required"
        ],
        'light' => [
            "icon" => "required",
            "link" => "required"
        ]
    ];


}
