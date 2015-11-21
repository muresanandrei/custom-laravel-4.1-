<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:28 AM
 */
namespace CoreApp\Admin\Validations;

class Admin extends \Abstracts\Validation {


    public $rules = array(

        'create' => array(
                            'email' 	   => 'required|max:200|email|unique:auth_users,email',
                            'first_name'   => 'required|max:150',
                            'last_name'    => 'required|max:150',
                            'language'     => 'required|in:en,ro',

        ),
        'change_password' => array(
                                    'current_password'     => 'required|min:6|max:40',
                                    'new_password'         => 'required|min:6|max:40',
                                    'confirm_new_password' => 'required|min:6|max:40|same:new_password'
        ),
        'edit'  =>  array(
                            'email'        => 'required|max:200|email|unique:auth_users,email,auth_id',
                            'first_name'   => 'required|max:150',
                            'last_name'    => 'required|max:150',
                            'language'     => 'required|in:en,ro',
        ),
        'redactor'  => array(
                                'file' => 'required|mimes:jpeg,bmp,png,jpg|max:10000'
        )

    );


}//class Admin