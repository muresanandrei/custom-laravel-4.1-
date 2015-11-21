<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class MovieTag {

    public $table = 'tags';


    public function all()
    {
    	return DB::table($this->table)
    			 ->get();
    }//all


     public function check_tag_id_exists($tag_id)
     {		
    	return DB::table($this->table)
        		 ->where('tag_id','=',$tag_id)
                 ->take(1)
                 ->pluck('tag_id');

     }//check_tag_id_exists

    public function get_tag_by_id($tag_id)
    {

        return DB::table($this->table)
                 ->where('tag_id','=',$tag_id)
                 ->take(1)
                 ->get();

    }//get_tag_by_id


}//end MovieTag