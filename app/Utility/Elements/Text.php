<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Text
{

    public  function generate($elem)
    {
        return "<div class='" . $elem['class'] . "'>
                    <label for=''>" . __(Helper::frontendFormatter($elem['name'])) . "</label>
                    <input type='" . $elem['type'] . "' name='" . $elem['name'] . "' class='form-control' value='" .($elem['value'] ?? ''). "'>
                </div>";
    }
}
