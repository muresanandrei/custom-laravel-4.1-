<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:40 AM
 */
namespace CoreApp\Authentication\Models;

use \Hash, \DB;

class Authentication {


    public function validate_credentials($email, $password)
    {

        $user = DB::table('auth_users')->where('email', '=', $email)->take(1)->get();

        /*
         * If the username doesn't exist
         */
        if( count($user) == 0 ) return false;



        /*
         * Check the password
         */
        if( ! Hash::check($password, $user[0]->password) ) return false;

        /*
         * If we got until here it means the credentials are ok
         */
        return $user[0];

    }//validate_credentials



    /*
     * Add a new user to auth and return it's ID
     */
    public function add_get_id($email, $password, $language)
    {

        return DB::table('auth_users')
                 ->insertGetId(array(
                                        'username' => $email,
                                        'email'    => $email,
                                        'password' => $password,
                                        'language' => $language
            ));

    }//add_get_id


    public function update_user_auth($id,$email, $language)
    {
        return DB::table('auth_users')
                 ->where('id','=',$id)
                 ->update(array(
                                 'email'    => $email,
                                 'language' => $language

            ));//update_user_auth

    }

    public function update_user_auth_email($id,$email)
    {

        return DB::table('auth_users')
                 ->where('id','=',$id)
                 ->update(array(
                                    'email' => $email
            ));

    }//update_user_auth_email


    /*
     * Get auth by id
     */
    public function get_auth_by_id($id)
    {

        return \DB::table('auth_users')
                  ->where('id','=',$id)
                  ->limit(1)
                  ->get(array('email','language'));

    }//get_auth_by_id




    /*
     * Update password
     */
    public function update_password($id, $password) {

        return DB::table('auth_users')
                 ->where('id','=',$id)
                 ->update(array(
                                 'password'    => $password

            ));//update_user_auth

    }//update_password

    public function auth_id_based_on_customer_id($customer_id)
    {

        $id =  DB::table('auth_users')
                 ->join('customers AS c','c.auth_user_id','=','auth_users.id')
                 ->where('c.id','=',$customer_id)
                 ->limit(1)
                 ->pluck('auth_users.id');

        if( $id == '' ) return false;

        return $id;

    }//auth_id_based_on_customer_id


    public function check_password_for_current_user($password)
    {

        $auth_id = \Session::get('user.id');

        $database_password =  DB::table('auth_users')
                                ->where('id','=',$auth_id)
                                ->take(1)
                                ->pluck('password');

        return Hash::check($password, $database_password);

    } //check_password_for_current_user


    public function delete($id){

        return DB::table('auth_users')
                 ->where('id','=',$id)
                 ->delete();

    }//delete

}//Authentication