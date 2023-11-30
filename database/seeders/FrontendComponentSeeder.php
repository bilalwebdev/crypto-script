<?php

namespace Database\Seeders;

use App\Models\FrontendComponent;
use Illuminate\Database\Seeder;

class FrontendComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "banner" => [
                'in_select_option' => false,
        
                "image_upload_ids" => ['image_one', 'image_two'],
        
                'non_iterable' => [
                    "image_one" => [
                        "type" => 'file',
                        'name' => 'image_one',
                        'validation' => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
                        "classes" => 'form-group col-md-3 mb-3',
                        'placeholder' => '',
                        'button_text' => 'Choose Banner Image',
                        'row_gap' => ''
                    ],
                    "image_two" => [
                        "type" => 'file',
                        'name' => 'image_two',
                        'validation' => 'sometimes|image|mimes:jpg,jpeg,png|max:4096',
                        "classes" => 'form-group col-md-3 mb-3',
                        'placeholder' => '',
                        'button_text' => 'Choose Banner Image',
                        'row_gap' => 'col-md-6'
                    ],
        
                    "title" => [
                        "type" => 'text',
                        'name' => 'title',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Banner Title'
                    ],
                    "color_text_for_title" => [
                        "type" => 'text',
                        'name' => 'color_text_for_title',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Color Text for Title'
                    ],
        
                    "description" => [
                        "type" => 'textarea',
                        'name' => 'description',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-12',
                        'placeholder' => 'Description'
                    ],
        
                    "button_text" => [
                        "type" => 'text',
                        'name' => 'button_text',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Button Text'
                    ],
                    "button_text_link" => [
                        "type" => 'text',
                        'name' => 'button_text_link',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Button Link'
                    ]
                ]
            ],
        
            "why_choose_us" => [
                'in_select_option' => true,
                'non_iterable' => [
                    "title" => [
                        "type" => 'text',
                        'name' => 'section_header',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Section Header'
                    ],
                ]
            ],
        
            "about" => [
                'in_select_option' => true,
                'non_iterable' => [
                    "title" => [
                        "type" => 'text',
                        'name' => 'section_header',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Section Header'
                    ],
                ]
            ],
            "benefits" => [
                'in_select_option' => true,
                'non_iterable' => [
                    "title" => [
                        "type" => 'text',
                        'name' => 'section_header',
                        'validation' => 'required',
                        'classes' => 'form-group col-md-6',
                        'placeholder' => 'Section Header'
                    ],
                ]
            ]
        
        ];

        $names = array_keys($data);

        foreach ($names as $value) {
            FrontendComponent::create([
                'name' => $value,
                'data' => $data[$value]
            ]);
        }

    }
}
