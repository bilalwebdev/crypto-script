<?php

namespace App\Utility\Sections;

use App\Utility\Schema;

class Trade
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
        'button_text' => 'Text',
        'button_link' => 'Text',
      ],
      'light' => [
        'image_one' => 'Upload',
        'section_header' => 'Text',
        'title' => 'Text',
        'color_text_for_title' => 'Text',
        'button_text' => 'Text',
        'button_link' => 'Text',
      ]
    ];

    public $classes = [
      'default' => [
        'section_header' => 'col-md-6',
        'title' => 'col-md-6',
        'color_text_for_title' => 'col-md-6',
        'button_text' => 'col-md-6',
        'button_link' => 'col-md-6',
      ],
      'light' => [
        'image_one' => 'col-md-3',
        'section_header' => 'col-md-12',
        'title' => 'col-md-6',
        'color_text_for_title' => 'col-md-6',
        'button_text' => 'col-md-6',
        'button_link' => 'col-md-6',
      ]
    ];

    public $validation = [
      'default' => [
        'title' => 'required',
        'color_text_for_title' => 'required',
        'button_text' => 'required',
        'button_link' => 'required',
        'section_header' => 'required',
      ],
      'light' => [
        "image_one" => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
        'title' => 'required',
        'color_text_for_title' => 'required',
        'button_text' => 'required',
        'button_link' => 'required',
        'section_header' => 'required',
      ]
    ];
}