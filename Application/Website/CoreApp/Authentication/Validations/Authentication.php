<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:39 AM
 */
namespace CoreApp\Authentication\Validations;

class Authentication extends \Abstracts\Validation {


    public $rules = array(
        'default' => array(
                            'email' 	=> 'required|max:200|email',
                            'password'  => 'required|max:200'
        ),
        'create' => array(
                            'email' 	=> 'required|max:200|email',
                            'password'  => 'required|max:200',
                            'language'  => 'required|in:en,ro'
        ),
        'reset' => array(
            'email'     => 'required|min:5|max:200|email|exists:auth_users,email'

        )
    );

}//class Authentication