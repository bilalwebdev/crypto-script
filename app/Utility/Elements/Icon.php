<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Icon
{

    public function generate($elem)
    {
       
        return '<div class="'.$elem['class'].'">
        <div class="input-group">
            <label for=""
                class="w-100">'.__(Helper::frontendFormatter($elem['name'])).'</label>
            <input type="text" class="form-control icon-value"
                name="'.$elem['name'].'"
                value="'.($elem['value']??'').'">
            <span class="input-group-append">
                <button class="btn btn-outline-primary iconpicker"
                    data-icon="fas fa-home" role="iconpicker"></button>
            </span>
        </div>
    </div>';
    }

}
