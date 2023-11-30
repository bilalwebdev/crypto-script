<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Brand
{
    use Schema;

    public $has_element = true;

    public $has_content = false;

    public $image_upload_ids = ['image_one'];

    public $elementFields = [
        'default' => [
            "image_one" => "Upload"
        ],
        'light' => [
            "image_one" => "Upload"
        ]
    ];

    public $elementClasses = [
        'default' => [
            "image_one" => "col-md-3"
        ],
        'light' => [
            "image_one" => "col-md-3"
        ]
    ];

    public $elementValidation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];
}
