<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models;

use \DB;

class UserIp {

    public $table = 'user_ip';


    public function insert_ip($ip,$user_agent,$movie_id)
    {

        return DB::table($this->table)
                 ->insert(array(
                                    'ip'            => $ip,
                                    'user_agent'    => $user_agent,
                                    'movie_id'      => $movie_id,
                                    'date'          => date("Y/m/d H:i:s")
            ));

    }//insert_ip

    public function get_ip_by_movie_id($movie_id)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->take(1)
                 ->get();

    }//get_ip_by_movie_id

}//end UserIp