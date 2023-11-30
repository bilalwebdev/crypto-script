<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Footer
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            "footer_short_details" => "Textarea",
            "image_one" => "Upload"
        ],
        'light' => [
            "footer_short_details" => "Textarea",
            "image_one" => "Upload"
        ]
    ];

    public $classes = [
        'default' => [
            "footer_short_details" => "col-md-12",
            "image_one" => "col-md-3"
        ],
        'light' => [
            "footer_short_details" => "col-md-12",
            "image_one" => "col-md-3"
        ]
    ];

    public $validation = [
        'default' => [
            "footer_short_details" => "required",
            "image_one" => "sometimes|image|mimes:jpg,jpeg,png|max:4096"
        ],
        'light' => [
            "footer_short_details" => "required",
            "image_one" => "sometimes|image|mimes:jpg,jpeg,png|max:4096"
        ]
    ];

}
