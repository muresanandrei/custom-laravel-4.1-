<?php
/**
 * User: andrei
 * Date: 3/25/14
 * Time: 4:59 PM
 */
namespace CoreApp\Website\Models;

use \DB;

class JournalPostTag {

    public $table = 'journal_post_tags';

    public function insert_journal_post_tags($tags)
    {

        return DB::table($this->table)
                 ->insert($tags);
            
    }//insert_journal_post_tags

    
    public function get_tags_by_journal_id($journal_id)
    {

        $tags_obj = DB::table($this->table)
                      ->where('journal_post_id','=',$journal_id)
                      ->get(array('tag_id'));

        $tags_array = array();

        foreach($tags_obj as $t)
        {

            $tags_array[] = $t->tag_id;

        }//foreach tags object

        return $tags_array;

    }//get_tags_by_journal_id


    public function delete_tags_by_journal_id($journal_id)
    {

        return DB::table($this->table)
                 ->where('journal_post_id','=',$journal_id)
                 ->delete();

    }//delete_tags_by_journal_id


    public function update_tags($journal_id,$tags)
    {

        return DB::table($this->table)
                 ->where('journal_post_id','=',$journal_id)
                 ->update($tags);
            
    }//update_tags


    
}//end JournalPostTag