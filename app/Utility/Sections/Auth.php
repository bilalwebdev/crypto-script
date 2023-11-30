<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Auth
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            "title" => "Text",
            'image_one' => 'Upload',
        ],
        'light' => [
            "title" => "Text",
            'image_one' => 'Upload',
        ]

    ];

    public $classes = [
        'default' => [
            "title" => "col-md-12",
            'image_one' => 'col-md-3',
        ],
        'light' => [
            "title" => "col-md-12",
            'image_one' => 'col-md-3',
        ]
    ];

    public $validation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
        ]
    ];

}
