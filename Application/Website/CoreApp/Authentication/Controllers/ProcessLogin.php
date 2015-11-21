<?php
/**
 * User: andrei
 * Date: 1/29/14
 * Time: 11:19 PM
 */

namespace CoreApp\Authentication\Controllers;

use \Input, \Session;

class ProcessLogin extends \Controller {


    public function index()
    {

        $validator = new \CoreApp\Authentication\Validations\Authentication(Input::only('email', 'password'));

        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('login')->withErrors($validator->errors());

        }//if validation didn't pass


        /*
         * Let's check if the email and password is correct
         */
        $model = \App::make('AuthenticationModel');

        $user = $model->validate_credentials(Input::get('email'), Input::get('password'));

        if( ! $user )
        {

            return \Redirect::to('login')->with('login_errors', true);


        }//if the login credentials are incorrect


        /*
         * The login credentials are ok, let's see what kind of implementation the user has
         */
        $user_type = \App::make('AuthenticationUserTypeModel');

        /*
         * Admin / Regular User ?
         */
        $user_implementation = $user_type->get_by_id($user->id);



        if( count( $user_implementation ) == 0 )
        {

            return \Redirect::to('login')->with('login_errors', true);

        }//if we don't have any user implementation

        $user_implementation = $user_implementation[0];



        /*
        * Check if regular user and if is active
        *
        */
        if ( $user_implementation->user_implementation_id == 2 ) {


            $regular_user_model = \App::make('RegularUserModel');


            $regular_user_id = $regular_user_model->regular_user_id_based_on_auth_id($user_implementation->auth_user_id);

            if (!$regular_user_model->is_active($regular_user_id)) {

                return \Redirect::to('login')->with('login_errors', true);

            }//if isn't active

        }//check



        /*
         * Start the user session and redirect to home
         */
        $user_session = new \SystemTools\UserSession($user_implementation->user_implementation_id,
            $user_implementation->auth_user_id,
            $user->language);

        $user_session->create_session();//create the session object with the necessary data

        $user_session->save_session();//add the session object to session

        if( $user_session->session_exists() )
        {

            return \Redirect::to(Session::get('user.home'));

        }//if we have a session


        /*
         * If the code got this far something went very wrong
         */
        return \Redirect::to('login')->with('login_errors', true);

    }//index

}//end Login