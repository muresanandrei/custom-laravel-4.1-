<?php
/**
 * User: andrei
 * Date: 2/21/14
 * Time: 1:40 AM
 */
namespace CoreApp\Website\Validations;

class Meta extends \Abstracts\Validation {


    public $rules = array(


        'update' => array(

                            'meta_description'     => 'required|max:200',
                            'meta_keywords'        => 'required|max:200'

        ),


    );


}//class Meta