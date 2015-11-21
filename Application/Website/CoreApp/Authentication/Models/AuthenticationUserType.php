<?php
/**
 * User: andrei
 * Date: 1/29/14
 * Time: 11:23 PM
 */
namespace CoreApp\Authentication\Models;

use \DB;

class AuthenticationUserType {

    public function get_by_id($id)
    {

        return DB::table('auth_user_type')->where('auth_user_id', '=', $id)->take(1)->get();

    }//get_by_id


    /**
     * @param $auth_user_id
     * @param $implementation // 1 = Admin, 2 = Regular user
     * @return mixed
     */
    public function insert_auth_user_id($auth_user_id, $implementation)
    {

        return DB::table('auth_user_type')
                 ->insert(array(

                                'auth_user_id'            => $auth_user_id,
                                'user_implementation_id'  => $implementation
            ));

    }//insert_auth_user_id


    public function delete_based_on_auth_id($auth_id) {

        return DB::table('auth_user_type')
                 ->where('auth_user_id','=',$auth_id)
                 ->delete();

    }//delete_based_on_auth_id


}//end AuthenticationUserType