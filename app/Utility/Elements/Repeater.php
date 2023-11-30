<?php

namespace App\Utility\Elements;

use App\Helpers\Helper\Helper;

class Repeater
{
    public function generate($elem)
    {

        $repeater = '';

      

        if(is_array($elem['value'])){
            foreach ($elem['value'] as $rep) {

               
               
                $repeater .= "
                
                <div data-repeater-item class='col-md-6 my-3 pl-0'>
                    <div class='input-group'>
                        <input type='text'
                            class='form-control-file form-control'
                            name='repeater'
                            value='".$rep->repeater."' />
                        <button data-repeater-delete type='button'
                            class='btn border-left-0 btn-outline-secondary text-danger'><i
                                class='fa fa-times'></i></button>
                    </div>
                </div>
                ";
                
            }
        }else{
            $repeater = "
            
              
                        <div data-repeater-item class='col-md-6 my-3 pl-0'>
                            <div class='input-group'>
                                <input type='text'
                                    class='form-control-file form-control'
                                    name='repeater'/>
                                <button data-repeater-delete type='button'
                                    class='btn border-left-0 btn-outline-secondary text-danger'><i
                                        class='fa fa-times'></i></button>
                            </div>
                        </div>
                    
            
            ";
        }




        return "<div class='col-md-12'>
                    <label for='' class='mt-3'>" . __(Helper::frontendFormatter($elem['name'])) . "<button
                            data-repeater-create type='button'
                            class='btn btn-sm btn-primary ml-3'><i
                                class='fa fa-plus'></i>
                            ".__('Add More')."</button>
                    </label>

                    <div data-repeater-list='repeater' class='d-flex flex-wrap'>
                       
                    
                        ".$repeater."


                        
                    </div>
                    
                </div>
            ";
    }
}
