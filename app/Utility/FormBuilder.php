<?php

namespace App\Utility;

use Illuminate\Support\Str;


class FormBuilder
{

    public static function render($section, $content = [], $type = 'content')
    {

        $class = self::classMap($section);


        return $class->generateHtml($content, $section, $type);
    }

    public static function classMap($request)
    {

        $element = ucfirst(Str::camel($request));

        $section = __NAMESPACE__ . '\\Sections\\' . $element;

        return new $section();
    }
}
