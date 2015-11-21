<?php
/**
 * User: andrei
 * Date: 2/9/14
 * Time: 12:50 AM
 */
namespace CoreApp\Website\Models;

use \DB;

class JournalCategory {

    public $table = 'journal_categories';


    public function insert_journal_category_get_id($meta_description,$meta_keywords,$category_url,$category)
    {

        return DB::table($this->table)
                 ->insertGetId(array(
                                        'meta_description'                        => $meta_description,
                                        'meta_keywords'                           => $meta_keywords,
                                        'category_url'                            => $category_url,
                                        'name'                                    => $category
            ));


    }//insert_journal_category_get_id


    public function get_category_by_id($category_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$category_id)
                 ->get();

    }//get_category_by_id
    

    public function update_category($category_id,$meta_description,$meta_keywords,$category_url,$category)
    {

        return DB::table($this->table)
                 ->where('id','=',$category_id)
                 ->update(array(
                                    'meta_description'                        => $meta_description,
                                    'meta_keywords'                           => $meta_keywords,
                                    'category_url'                            => $category_url,
                                    'name'                                    => $category
                    ));

    }//update_category


    public function all()
    {

        return DB::table($this->table)
                 ->get();

    }//all

    public function category_name_by_id($category_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$category_id)
                 ->take(1)
                 ->pluck('name');

    }//category_name_by_id
    

    public function check_id_exists($category_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$category_id)
                 ->take(1)
                 ->pluck('id');

    }//check_id_exists

    public function get_all_categories_paginated($per_page)
    {

       $query = DB::table($this->table)
                  ->remember(120)
                  ->select(array(       "{$this->table}.id as category_id",
                                        "{$this->table}.name as category"

                  ));

         return $query->paginate($per_page);

    }//get_all_categories_paginated
    

    public function delete($id)
    {
        return DB::table($this->table)
                 ->where('id','=',$id)
                 ->delete();
    }//delete


}//end JournalCategory