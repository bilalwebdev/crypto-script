<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Upload
{

    public function generate($elem)
    {

        $path = Helper::getFile($elem['section'], $elem['value']);
        
        return "<div class='" . $elem['class'] . "'>
                <label class='col-form-label'>" . __(Helper::frontendFormatter($elem['name'])) . "</label>
                <div id='image-preview-" . $elem['name'] . "'
                    class='image-preview' style='background-image:url($path);'>
                    <label for='image-upload-" . $elem['name'] . "'
                        id='image-label-" . $elem['name'] . "'>Upload Image</label>
                    <input type='file' name='" . $elem['name'] . "'
                        id='image-upload-" . $elem['name'] . "' />
                </div>
    
            </div>
            ";
    }
}
