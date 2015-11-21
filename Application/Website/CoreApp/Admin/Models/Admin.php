<?php
/**
 * User: andrei
 * Date: 2/3/14
 * Time: 11:05 PM
 */

namespace CoreApp\Admin\Models;

use \DB;

class Admin {


    public $home_route = 'admin/home';

    /**
     * Returns the name needed for user session (see SystemTools\UserSession)
     *
     * @param int $auth_id // the auth id of the user
     *
     * @return string / bool
     */
    public function user_session_name_by_auth_id($auth_id)
    {

        $db_data = DB::table('all_admins_name')->where('auth_user_id', '=', $auth_id)->take(1)->get();



        if( count( $db_data ) > 0)
        {

            return $db_data[0]->first_name . ' ' . $db_data[0]->last_name;

        }//if we have db data

        return false;

    }//user_session


}//end Admin