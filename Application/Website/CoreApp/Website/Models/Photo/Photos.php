<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Photo;

use \DB;

class Photos {

    public $table = 'photo_gallery_categories';


     public function all()
     {
        return DB::table($this->table)
                 ->get();

    }//all

    public function check_id_exists($id)
    {

        return DB::table($this->table)
                 ->where('id','=',$id)
                 ->take(1)
                 ->pluck('id');

    }//check_id_exists


    public function delete($id)
    { 

        return DB::table($this->table)
                 ->where('id','=',$id)
                 ->delete();

     }//delete

     public function get_photo_gallery_meta_by_id($id)
     {

            return DB::table($this->table)
                     ->where('id','=',$id)
                     ->take(1)
                     ->get();

     }//get_photo_gallery_meta_by_id

}//end Photos