<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Team
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
            "member_name" => "Text",
            "designation" => "Text",
            "facebook_url" => "Text",
            "twitter_url" => "Text",
            "linkedin_url" => "Text",
            "instagram_url" => "Text",
            "image_one" => "Upload",
        ],
        'light' => [
            "member_name" => "Text",
            "designation" => "Text",
            "facebook_url" => "Text",
            "twitter_url" => "Text",
            "linkedin_url" => "Text",
            "instagram_url" => "Text",
            "image_one" => "Upload",
        ]       
    ];

    public $elementClasses = [
        'default' => [
            "member_name" => "col-md-6",
            "designation" => "col-md-6",
            "facebook_url" => "col-md-6",
            "twitter_url" => "col-md-6",
            "linkedin_url" => "col-md-6",
            "instagram_url" => "col-md-6",
            "image_one" => "col-md-3",
        ],
        'light' => [
            "member_name" => "col-md-6",
            "designation" => "col-md-6",
            "facebook_url" => "col-md-6",
            "twitter_url" => "col-md-6",
            "linkedin_url" => "col-md-6",
            "instagram_url" => "col-md-6",
            "image_one" => "col-md-3",
        ]
    ];

    public $elementValidation = [
        'default' => [
            "member_name" => "required",
            "designation" => "required",
            "facebook_url" => "required",
            "twitter_url" => "required",
            "linkedin_url" => "required",
            "instagram_url" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ],
        'light' => [
            "member_name" => "required",
            "designation" => "required",
            "facebook_url" => "required",
            "twitter_url" => "required",
            "linkedin_url" => "required",
            "instagram_url" => "required",
            "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        ]
    ];

}
