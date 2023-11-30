<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Overview
{
    use Schema;

    public $has_element = true;

    public $has_content = true;

    public $image_upload_ids = ['image_one'];

    public $fields = [
        'default' => [
           
        ],
        'light' => [
            'title' => 'Text',
            'color_text_for_title' => 'Text',
            'description' => 'Textarea',
            'image_one' => 'Upload'
        ]
    ];

    public $classes = [
        'default' => [
            
        ],
        'light' => [
            'image_one' => 'col-md-3',
            'title' => 'col-md-6',
            'color_text_for_title' => 'col-md-6',
            'description' => 'col-md-12',
        ]
    ];

    public $validation = [
        'default' => [
            
        ],
        'light' => [
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
            'title' => 'required',
            'color_text_for_title' => 'required',
            'description' => 'required',
        ]
    ];



    public $elementFields = [
        'default' => [
            'title' => 'Text',
            'icon' => 'Icon',
            'counter' => 'Text'
        ],
        'light' => [
            'title' => 'Text',
            'counter' => 'Text'
        ]
    ];

    public $elementClasses = [
        'default' => [
            'title' => 'col-md-6',
            'icon' => 'col-md-6',
            'counter' => 'col-md-12'
        ],
        'light' => [
            'title' => 'col-md-6',
            'counter' => 'col-md-12'
        ]
    ];

    public $elementValidation = [
        'default' => [
            'title' => 'required',
            'icon' => 'required',
            'counter' => 'required'
        ],
        'light' => [
            'title' => 'required',
            'counter' => 'required'
        ]
    ];


}
