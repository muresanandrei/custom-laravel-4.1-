<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:14 AM
 */
namespace BaseControllers;

use \View, \App;

class Webrising extends \Controller {

    public $session = array();

    public function __construct()
    {

        $this->session = \SystemTools\UserSession::data();

        /*
         * Share the name from session across all views
         */
        View::share('session_name', $this->session['name']);


        /*
         * Share the home route
         */
        View::share('user_home', $this->session['home']);


        /*
         * Share the selected language
         */
        View::share('user_language', $this->session['language']);


        /*
         * Set the language
         */
        App::setLocale($this->session['language']);


    }//__construct

}//end Webrising