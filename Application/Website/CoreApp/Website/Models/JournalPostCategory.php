<?php
/**
 * User: andrei
 * Date: 2/9/14
 * Time: 4:58 PM
 */
namespace CoreApp\Website\Models;

use \DB;

class JournalPostCategory {

    public $table = 'journal_post_categories';


    public function insert_journal_post_id_category_id($journal_id,$category_id)
    {

        return DB::table($this->table)
                 ->insert(array(

                                'journal_post_id'      => $journal_id,
                                'journal_category_id'  => $category_id
            ));


    }//insert_journal_post_id_category_id

    public function get_category_id_by_journal_id($journal_id)
    {

        return DB::table($this->table)
                 ->where('journal_post_id','=',$journal_id)
                 ->take(1)
                 ->pluck('journal_category_id');

    }//get_category_id_by_journal_id


    public function update_journal_post_id_category_id($journal_id,$category_id)
    {


        return DB::table($this->table)
                 ->where('journal_post_id','=',$journal_id)
                 ->update(array(
                                    'journal_category_id' => $category_id
            ));


    }//update_journal_post_id_category_id


     public function delete($id)
     {

        return DB::table($this->table)
                 ->where('journal_post_id','=',$id)
                 ->delete();

     }//delete

}//end JournalPostCategory