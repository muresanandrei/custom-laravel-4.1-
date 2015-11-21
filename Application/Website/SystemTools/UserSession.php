<?php
/**
 * User: andrei
 * Date: 1/24/14
 * Time: 11:54 PM
 */
namespace SystemTools;

use \App, \Session;

class UserSession {

    protected $session = array(
        'name'      => '',
        'type'      => '',//admin = 1,regular user = 2, customer = 3
        'home'      => '',//the home page route of that kind of user
        'auth_id'   => ''//not set
    );

    protected $user_implementation_id;//the id of the implementation (Admin,User,Customer)

    protected $auth_user_id;//the id of the user (the one from auth, not the implementation)

    protected $language;//the language selected by this user (abbreviation, e.g. en, de)

    public function __construct($user_implementation_id, $auth_user_id, $language)
    {

        $this->user_implementation_id = (int)$user_implementation_id;

        $this->auth_user_id = (int)$auth_user_id;

        $this->language = $language;

    }//__construct()


    /**
     * Creates the session array with the proper data based on the user auth id and it's implementation
     *
     * $return void
     */
    public function create_session()
    {

        /*
         * If it's Admin
         */
        if( $this->user_implementation_id == 1 )
        {

            $model = App::make('AdminModel');

        }//if the user is Admin
        elseif( $this->user_implementation_id == 2)
        {
            $model = App::make('RegularUserModel');

        }//else if is regular user
        else
        {

            $model = App::make('CustomerModel');

        }//if it's customer


        $this->session['name'] = $model->user_session_name_by_auth_id($this->auth_user_id);

        $this->session['home'] = $model->home_route;

        $this->session['type'] = $this->user_implementation_id;

        $this->session['id']   = $this->auth_user_id;

        $this->session['language']   = $this->language;

    }//save


    /**
     * Create the session based on this->session
     */
    public function save_session()
    {

        Session::put('user', $this->session);

    }//save_session



    /**
     * Checks if a valid user session exists
     *
     * @return bool
     */
    public static function session_exists()
    {

        return Session::has('user');

    }//session_exists


    public static function destroy_session()
    {

        Session::forget('user');

    }//destroy_session



    /**
     * return the session data
     */
    public static function data()
    {

        return Session::get('user');

    }//data


    /**
     * Used to check if a user session is for admin
     */
    public static function is_admin()
    {

        return Session::get('user.type') == 1 ? true : false;

    }//is_admin


}//end UserSession