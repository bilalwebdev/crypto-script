<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Plans
{
    use Schema;

    public $has_element = false;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
            'section_header' => 'Text',
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'image_one' => 'Upload'
        ],
        'light' => [
            'section_header' => 'Text',
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'image_one' => 'Upload'
        ]
    ];

    public $classes = [
        'default' => [
            'image_one' => 'col-md-3',
            'section_header' => 'col-md-6',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-12'
        ],
        'light' => [
            'image_one' => 'col-md-3',
            'section_header' => 'col-md-6',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-12'
        ]
    ];

    public $validation = [
        'default' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'section_header' => 'required',
            'title' => 'required',
            'color_text_for_title' => 'required'
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'section_header' => 'required',
            'title' => 'required',
            'color_text_for_title' => 'required'
        ]
    ];

}
