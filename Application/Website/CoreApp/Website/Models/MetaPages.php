<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models;

use \DB;

class MetaPages {

    public $table = 'meta_pages';


    public function all()
    {

        return DB::table($this->table)
                 ->get();

    }//all

    public function update_meta($page_id,$meta_description,$meta_keywords)
    {

        return DB::table($this->table)
                 ->where('id','=',$page_id)
                 ->update(array(
                                    'meta_description' => $meta_description,
                                    'meta_keywords'    => $meta_keywords
            ));

    }//update_meta

    public function get_meta_by_id($page_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$page_id)
                 ->take(1)
                 ->get();

    }//get_meta_by_id

}//end MetaPages