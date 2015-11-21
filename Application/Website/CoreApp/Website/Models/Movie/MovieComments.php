<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class MovieComments {

    protected $table = 'movie_comments';


    public function insert_comment($ip,$movie_id,$name,$comment)
    {

        return DB::table($this->table)
                 ->insert(array(
                                    'ip'            => $ip,
                                    'movie_id'      => $movie_id,
                                    'name'          => $name,
                                    'comment'       => $comment,
                                    'date'          => date("Y/m/d H:i:s")
            ));

    }//insert_comment

     public function get_movie_comment_by_status_and_movie_id($movie_id,$take)
     {

          return  DB::table($this->table)
                    ->where('movie_id','=',$movie_id)
                    ->where('status','=',1)
                    ->orderBy('date','desc')
                    ->take($take)
                    ->get();        

     }//get_movie_comment_by_status_and_movie_id


    public function count_comments_by_movie_id($movie_id)
    {

            return DB::table($this->table)
                     ->where('movie_id','=',$movie_id)
                     ->where('status','=',1)
                     ->count();

    }//count_comments_by_movie_id

    public function get_all_comments()
    {
            return DB::table($this->table)
                     ->get();

    }//get_all_comments

    public function approve($comment_id)
    {
            return DB::table($this->table)
                     ->where('id','=',$comment_id)
                     ->update(array('status' => 1));
    }//aprove


    public function disable($comment_id)
    {
            return DB::table($this->table)
                     ->where('id','=',$comment_id)
                     ->update(array('status' => 0));
    }//disable

    public function delete($comment_id)
    {
            return DB::table($this->table)
                     ->where('id','=',$comment_id)
                     ->delete();
    }//delete

}//end Movie Comments