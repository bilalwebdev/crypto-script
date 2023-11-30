<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Date
{

    public function generate($elem)
    {
        return "<div class='" . $elem['class'] . "'>
                    <label for=''>" . __(Helper::frontendFormatter($elem['name'])) . "</label>
                    <input type='text' name='" . $elem['name'] . "' class='form-control datepicker' value='" . ($elem['value'] ?? '') . "'>
                </div>";
    }
}
