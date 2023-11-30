<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Textarea
{

    public function generate($elem)
    {
       
        return "<div class='" . $elem['class'] . "'>
                    <label for=''>" . __(Helper::frontendFormatter($elem['name'])) . "</label>
                    <textarea name='" . $elem['name'] . "' class='form-control form-textarea'>".($elem['value']??'')."</textarea>
                </div>";
    }

   
}