<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class MovieCategories {

    public $table = 'movie_categories';

    public function insert_movie_categories($categories)
    {

        return DB::table($this->table)
                 ->insert($categories);
            

    }//insert_movie_categories


     public function get_categories_id_by_movie_id($movie_id)
    {

        return $cat_obj =DB::table($this->table)
                           ->where('movie_id','=',$movie_id)
                           ->get(array('cat_id'));

                 $categories_array = array();

                foreach($cat_obj as $c)
                {

                    $categories_array[] = $c->cat_id;

                }//foreach tags object

                return $categories_array;

    }//get_categories_id_by_movie_id


    public function update_movie_id_category_id($movie_id,$category_id)
    {


        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->update(array(
                                    'movie_cat_id' => $category_id
            ));


    }//update_movie_id_category_id


    public function delete($id)
     {

        return DB::table($this->table)
                 ->where('movie_id','=',$id)
                 ->delete();

     }//delete

}//end MovieCategories