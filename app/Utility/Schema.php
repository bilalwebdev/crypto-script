<?php

namespace App\Utility;

use App\Helpers\Helper\Helper;
use App\Models\Configuration;

trait Schema
{

    public function schema($data, $sectionName, $type)
    {

        if ($type == 'element') {
            return $this->build($data, $this->elementFields,  $this->elementClasses, $sectionName);
        }


        if ($this->has_content) {
            return $this->build($data, $this->fields, $this->classes,  $sectionName);
        }
    }


    public function build($data, $fields, $classes, $sectionName)
    {
        $content = '';

        $activeTheme = Helper::config()->theme;

        foreach ($fields[$activeTheme] as $key => $value) {
            $elem = [
                'class' => $classes[$activeTheme][$key] ?? '',
                'type' => $value,
                'name' => $key,
                'value' => $data->content->$key ?? '',
                'section' => $sectionName,
            ];

            $section = __NAMESPACE__ . '\\Elements\\' . $value;

            $class = new $section();

            $content .= $class->generate($elem);

        }


        return $content;
    }


    public function generateHtml($data, $section,$type)
    {
        return [
            'html' => $this->schema($data, $section,$type),
            'image_id' => $this->image_upload_ids,
            'has_element' => $this->has_element,
            'has_content' => $this->has_content
        ];
    }


    public function sectionHtml($sectionName)
    {
        $content = Helper::builder($sectionName);

        $data['content'] = optional($content)->content;
        
        $data['element'] = Helper::builder($sectionName, true);
        
        return view(Helper::theme() . 'widgets.'.$sectionName)->with($data);
    }
}
