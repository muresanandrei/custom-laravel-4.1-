<?php
/**
 * User: andrei
 * Date: 3/26/14
 * Time: 1:46 AM
 */
namespace CoreApp\Website\Validations;

class Contact extends \Abstracts\Validation {


    public $rules = array(
                            
        'contact'  => array(

                                'name'             => 'required|max:150',
                                'email'            => 'required|max:150|email',
                                'subject'          => 'required|max:100',
                                'message'          => 'required|max:300'
            )

    );


}//class Contact