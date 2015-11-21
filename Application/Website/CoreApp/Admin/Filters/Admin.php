<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:31 AM
 */

namespace CoreApp\Admin\Filters;

class Admin {

    public function filter()
    {

        if( ! \SystemTools\UserSession::session_exists() || ! \SystemTools\UserSession::is_admin() )
        {

            return \Redirect::to('login');

        }//if we don't have a session

    }//filter

}//end Admin