<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 8:01 PM
 */
namespace CoreApp\Website\Models;

use \DB;

class WebsiteJournal {

    public $table = 'journal_posts';

    public function insert_journal_get_id($meta_description,$meta_keywords,$post_url,$title,$post,$journal_image_extension,$featured)
    {

        return DB::table($this->table)
                 ->insertGetId(array(
                                      'meta_description'                => $meta_description,
                                      'meta_keywords'                   => $meta_keywords,
                                      'post_url'                        => $post_url,
                                      'title'                           => $title,
                                      'post'                            => $post,
                                      'journal_image_extension'         => $journal_image_extension,
                                      'featured'                        => $featured,
                                      'auth_user_id'                    => \Session::get('user.id'),
                                      'date_posted'                     => date('Y-m-d H:i:s')
            ));


    }//insert_journal_get_id

    public function check_id_exists($journal_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$journal_id)
                 ->take(1)
                 ->pluck('id');

    }//check_id_exists

    public function get_post_by_journal_id($journal_id)
    {

        return DB::table($this->table)
                 ->where('id','=',$journal_id)
                 ->get();

    }//get_post_by_journal_id

    public function update_journal($journal_id,$meta_description,$meta_keywords,$post_url,$title,$post,$journal_image_extension,$featured)
    {

        return DB::table($this->table)
                 ->where('id','=',$journal_id)
                 ->update(array(
                                    'meta_description'                => $meta_description,
                                    'meta_keywords'                   => $meta_keywords,
                                    'post_url'                        => $post_url,
                                    'title'                           => $title,
                                    'post'                            => $post,
                                    'journal_image_extension'         => $journal_image_extension,
                                    'featured'                        => $featured
            ));

    }//update journal

    public function get_all_posts_paginated($per_page)
    {
       $query = DB::table($this->table)
                  ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                  ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                  ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                  ->orderBy("{$this->table}.date_posted", 'desc')
                  ->remember(120)
                  ->select(array(       "{$this->table}.id as journal_id",
                                        "{$this->table}.post_url",
                                        "{$this->table}.title",
                                        "{$this->table}.post",
                                        "{$this->table}.journal_image_extension",
                                        "{$this->table}.featured",
                                        "{$this->table}.date_posted",
                                        "jc.category_url",
                                        "jc.name as category_name",
                                        "jc.id as category_id",
                                        DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                  ));

         return $query->paginate($per_page);

    }//get_all_posts_paginated


    public function get_single_journal_by_id($journal_id)
    {
       return DB::table($this->table)
                  ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                  ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                  ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                  ->where("{$this->table}.id",'=',$journal_id)
                  ->take(1)
                  ->get(array(          "{$this->table}.id as journal_id",
                                        "{$this->table}.meta_description",
                                        "{$this->table}.meta_keywords",
                                        "{$this->table}.post_url",
                                        "{$this->table}.title",
                                        "{$this->table}.post",
                                        "{$this->table}.journal_image_extension",
                                        "{$this->table}.journal_header_image_extension",
                                        "{$this->table}.featured",
                                        "{$this->table}.date_posted",
                                        "jc.category_url",
                                        "jc.name as category_name",
                                        "jc.id as category_id",
                                        DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                  ));

    }//get_single_journal_by_id



    public function get_last_5_posts()
    {
           return DB::table($this->table)
                      ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                      ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                      ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                      ->orderBy("{$this->table}.date_posted", 'desc')
                      ->take(5)
                      ->get(array(          "{$this->table}.id as journal_id",
                                            "{$this->table}.post_url",
                                            "{$this->table}.title",
                                            "{$this->table}.post",
                                            "{$this->table}.journal_image_extension",
                                            "{$this->table}.featured",
                                            "{$this->table}.date_posted",
                                            "jc.id as category_id",
                                            "jc.category_url",
                                            "jc.name as category_name",

                                            
                                            DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                      ));

    }//get_single_journal_by_id

    

    public function get_posts_by_category_id($category_id,$per_page)
    {

      $query = DB::table($this->table)
                 ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                 ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                 ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                 ->orderBy("{$this->table}.date_posted", 'desc')
                 ->where('jpc.journal_category_id','=',$category_id)
                 ->remember(120)
                 ->select(array(        "{$this->table}.id as journal_id",
                                        "{$this->table}.post_url",
                                        "{$this->table}.title",
                                        "{$this->table}.post",
                                        "{$this->table}.journal_image_extension",
                                        "{$this->table}.featured",
                                        "{$this->table}.date_posted",
                                        "jc.id as category_id",
                                        "jc.category_url",
                                        "jc.name as category_name",
                                        
                                        DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                  ));

         return $query->paginate($per_page);

    }//get_posts_by_category_id



    public function get_posts_by_tag_id($tag_id,$per_page)
    {
        
      
        $query = DB::table($this->table)
                   ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                   ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                   ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                   ->join('journal_post_tags as jpt','jpt.journal_post_id','=',"{$this->table}.id")
                   ->orderBy("{$this->table}.date_posted", 'desc')
                   ->where('jpt.tag_id','=',$tag_id)
                   ->remember(120)
                   ->select(array(      "{$this->table}.id as journal_id",
                                        "{$this->table}.post_url",
                                        "{$this->table}.title",
                                        "{$this->table}.post",
                                        "{$this->table}.journal_image_extension",
                                        "{$this->table}.featured",
                                        "{$this->table}.date_posted",
                                        "jc.id as category_id",
                                        "jc.category_url",
                                        "jc.name as category_name",
                                        DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                  ));

         return $query->paginate($per_page);

    }//get_posts_by_tag_id


    public function get_posts_by_date($month,$year,$per_page)
    {

      $query = DB::table($this->table)
                 ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                 ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                 ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                 ->whereRaw("Month(date_posted) = {$month}")
                 ->whereRaw("YEAR(date_posted) = {$year}")
                 ->orderBy("{$this->table}.date_posted", 'desc')
                 ->remember(120)
                 ->select(array(        "{$this->table}.id as journal_id",
                                        "{$this->table}.post_url",
                                        "{$this->table}.title",
                                        "{$this->table}.post",
                                        "{$this->table}.journal_image_extension",
                                        "{$this->table}.featured",
                                        "{$this->table}.date_posted",
                                        "jc.id as category_id",
                                        "jc.category_url",
                                        "jc.name as category_name",
                                        DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                  ));

         return $query->paginate($per_page);

    }//get_posts_by_date
    

    public function journal_search($search,$per_page)
    {

        $query = DB::table($this->table)
                   ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                   ->join('journal_categories as jc','jc.id','=','jpc.journal_category_id')
                   ->join('all_admins_name as aan','aan.auth_user_id','=',"{$this->table}.auth_user_id")
                   ->orderBy("{$this->table}.date_posted", 'desc');


        if( $search != '!' )
        {

            $query->where( function($query) use ($search)
            {

                $query->where("{$this->table}.title", 'LIKE', "%{$search}%");
                $query->OrWhere('jc.name', 'LIKE', "%{$search}%");

            });//


        }//if we need to search



        return $query->paginate($per_page, array(
                                                    "{$this->table}.id as journal_id",
                                                    "{$this->table}.post_url",
                                                    "{$this->table}.title",
                                                    "{$this->table}.post",
                                                    "{$this->table}.journal_image_extension",
                                                    "{$this->table}.featured",
                                                    "{$this->table}.date_posted",
                                                    "jc.id as category_id",
                                                    "jc.category_url",
                                                    "jc.name as category_name",
                                                    DB::raw('CONCAT(aan.first_name, " ", aan.last_name) AS author_name')
                                        ));


    }//journal_search

    public function delete($id)
    {

        return DB::table($this->table)
                 ->where('id','=',$id)
                 ->delete();

    }//delete


    public function count_posts_by_category_id($cat)
    {
       return DB::table($this->table)
                ->join('journal_post_categories as jpc','jpc.journal_post_id','=',"{$this->table}.id")
                ->where('jpc.journal_category_id','=',$cat)
                ->count();
                
    }//count_posts_by_category_id


    public function distinct_journal_dates()
    {

        return DB::table($this->table)
                 ->select(DB::raw("DISTINCT DATE_FORMAT(date_posted,'%M %Y') as distinct_date"))
                 ->get();
       
    }//distinct_journal_dates


}//end WebsiteJournal