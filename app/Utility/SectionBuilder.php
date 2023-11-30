<?php

namespace App\Utility;

use Illuminate\Support\Str;

class SectionBuilder
{

    public static function render($section)
    {
      
        $class = self::classMap($section);

        return $class->sectionHtml($section);
    }

    public static function classMap($request)
    {

        $element = ucfirst(Str::camel($request));

        $section = __NAMESPACE__ . '\\Sections\\' . $element;

        return new $section();
    }
}
