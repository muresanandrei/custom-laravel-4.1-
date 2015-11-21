<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class MovieTags {

    public $table = 'movie_tags';

    public function insert_movie_tags($tags)
    {

        return DB::table($this->table)
                 ->insert($tags);
            
    }//insert_movie_tags


     public function get_tags_by_movie_id($movie_id)
     {

        $tags_obj = DB::table($this->table)
                      ->where('movie_id','=',$movie_id)
                      ->get(array('tag_id'));

        $tags_array = array();

        foreach($tags_obj as $t)
        {

            $tags_array[] = $t->tag_id;

        }//foreach tags object

        return $tags_array;

      }//get_tags_by_movie_id



    public function update_tags($movie_id,$tags)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->update($tags);
            
    }//update_tags



    public function delete($id)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$id)
                 ->delete();

     }//delete

}//end MovieTags