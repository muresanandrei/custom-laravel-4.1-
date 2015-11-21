<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class MovieCategory {

    public $table = 'categories';
    

    public function all()
    {
    	return DB::table($this->table)
    			 ->get();
    }//all


    public function check_category_id_exists($category_id)
    {		
    	return DB::table($this->table)
        		 ->where('cat_id','=',$category_id)
                 ->take(1)
                 ->pluck('cat_id');

    }//check_category_id_exists

    public function get_category_by_id($category_id)
    {

        return DB::table($this->table)
                 ->where('cat_id','=',$category_id)
                 ->take(1)
                 ->get();

    }//get_category_by_id

}//end MovieCategory