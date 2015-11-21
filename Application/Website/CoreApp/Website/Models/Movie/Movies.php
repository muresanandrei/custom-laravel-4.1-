<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 11:23 AM
 */
namespace CoreApp\Website\Models\Movie;

use \DB;

class Movies {

    public $table = 'movies';


     public function get_all_movies()
     {
        return DB::table($this->table)
                  ->orderBy("{$this->table}.date", 'desc')
                  ->remember(120)
                  ->get();

    }//get_all_movies


    public function get_all_movies_paginated($per_page)
    {
        $movies = DB::table($this->table)
                    ->orderBy("{$this->table}.date",'desc')
                    ->remember(60)
                    ->select(array(
                                     "{$this->table}.movie_id",
                                     "{$this->table}.movie_url",
                                     "{$this->table}.title",
                                     "{$this->table}.time",
                                     "{$this->table}.plus",
                                     "{$this->table}.featured"
                  ));

         return $movies->paginate($per_page);  

    }//get all movies paginated


    public function insert_movie_get_id($meta_description,$meta_keywords,$movie_url,$embed_code,$title,$description,$time,$views,$featured)
    {

        return DB::table($this->table)
                 ->insertGetId(array(
                                      'meta_description'                => $meta_description.'Starfuck is a free porn website.',
                                      'meta_keywords'                   => $meta_keywords,
                                      'movie_url'                       => $movie_url,
                                      'embed'                           => $embed_code,
                                      'title'                           => $title,
                                      'description'                     => $description,
                                      'time'                            => $time,
                                      'plus'                            => rand(561,2567),
                                      'views'                           => $views,
                                      'featured'                        => $featured,
                                      'date'                            => date('Y-m-d')
            ));


    }//insert_movie_get_id

    public function check_id_exists($movie_id)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->take(1)
                 ->pluck('movie_id');

    }//check_id_exists


    public function get_movie_by_id($movie_id)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->get();

    }//get_movie_by_id

    public function update_movie($movie_id,$meta_description,$meta_keywords,$movie_url,$embed_code,$title,$description,$time,$views,$featured)
    {

        return DB::table($this->table)
                 ->where('movie_id','=',$movie_id)
                 ->update(array(
                                    'meta_description'                => $meta_description.'Starfuck is a free porn website.',
                                    'meta_keywords'                   => $meta_keywords,
                                    'movie_url'                       => $movie_url,
                                    'embed'                           => $embed_code,
                                    'title'                           => $title,
                                    'description'                     => $description,
                                    'time'                            => $time,
                                    'views'                           => $views,
                                    'featured'                        => $featured
            ));

    }//update movie


    public function delete($id)
    { 

        return DB::table($this->table)
                 ->where('movie_id','=',$id)
                 ->delete();

     }//delete


    public function get_single_movie_by_id($movie_id)
    {
       return DB::table($this->table)
                ->join('movie_categories as mc','mc.movie_id','=',"{$this->table}.movie_id")
                ->join('categories as c','c.cat_id','=','mc.cat_id')
                ->where("{$this->table}.movie_id",'=',$movie_id)
                ->take(1)
                ->get(array(          "{$this->table}.movie_id",
                                      "{$this->table}.meta_description",
                                      "{$this->table}.meta_keywords",
                                      "{$this->table}.movie_url",
                                      "{$this->table}.embed",
                                      "{$this->table}.title",
                                      "{$this->table}.description",
                                      "{$this->table}.time",
                                      "{$this->table}.plus",
                                      "{$this->table}.minus",
                                      "{$this->table}.views",
                                      "{$this->table}.featured",
                                      "{$this->table}.date",
                                      "c.cat_url",
                                      "c.name as category_name",
                                      "c.cat_id as category_id"
                ));

    }//get_single_movie_by_id


    public function get_movie_categoris_by_movie_id($movie_id)
    {

        $obj = DB::table($this->table)
                 ->join('movie_categories as mc','mc.movie_id','=',"{$this->table}.movie_id")
                 ->join('categories as c','c.cat_id','=','mc.cat_id')
                 ->where("mc.movie_id",'=',$movie_id)
                 ->get(array(
                              'c.cat_id',
                              'c.name',
                              'c.cat_url'
                  ));

        $categories = array();

        foreach($obj as $o)
        {
            $categories[] = $o;

        }//foreach cat

        return $categories;

    }//get_movie_categoris_by_movie_id



    public function get_movie_tags_by_movie_id($movie_id)
    {

        $obj = DB::table($this->table)
                 ->join('movie_tags as mt','mt.movie_id','=',"{$this->table}.movie_id")
                 ->join('tags as t','t.tag_id','=','mt.tag_id')
                 ->where("mt.movie_id",'=',$movie_id)
                 ->get(array(
                              "t.tag_id",
                              "t.name",
                              "t.tag_url"
                  ));

        $tags = array();

        foreach($obj as $o)
        {
            $tags[] = $o;

        }//foreach cat

        return $tags;

    }//get_movie_tags_by_movie_id


  public function get_latest_5_featured_movies()
  {
           return DB::table($this->table)
                    ->where("{$this->table}.featured",'=',2)
                    ->orderBy("{$this->table}.date", 'desc')
                    ->take(5)
                    ->get(array(          "{$this->table}.movie_id",
                                          "{$this->table}.movie_url",
                                          "{$this->table}.title",
                                          "{$this->table}.time"
                    ));

    }//get_latest_5_featured_movies


    public function related_movies_by_movie_categories($categories,$movie_id)
    {
        $categories_id = array();

        foreach($categories as $c){

            $categories_id[] = $c->cat_id;

        }//foreach categories id
        
        return DB::table($this->table)
                 ->join('movie_categories as mc','mc.movie_id','=',"{$this->table}.movie_id")
                 ->join('categories as c','c.cat_id','=','mc.cat_id')
                 ->whereIn("c.cat_id",$categories_id)
                 ->where("{$this->table}.movie_id",'!=',$movie_id)
                 ->orderBy("{$this->table}.date",'desc')
                 ->take(9)
                 ->get(array(
                                "{$this->table}.movie_id",
                                "{$this->table}.movie_url",
                                "{$this->table}.title",
                                "{$this->table}.time",
                                "{$this->table}.plus",
                                "{$this->table}.featured"


                  ));


    }//related_movies_by_movie_categories

    public function increment_views_by_movie_id($movie_id)
    {
           return DB::table($this->table)
                    ->where('movie_id','=',$movie_id)
                    ->increment('views');

    }//increment_views_by_movie_id


    public function increment_spanks_by_movie_id($movie_id)
    {
        return DB::table($this->table)
                  ->where('movie_id','=',$movie_id)
                  ->increment('plus');

    }//increment_spanks_by_movie_id

    public function get_all_movies_by_category_id_paginated($category_id,$per_page)
    {

      $movies = DB::table($this->table)
                  ->join('movie_categories as mc','mc.movie_id','=',"{$this->table}.movie_id")
                  ->join('categories as c','c.cat_id','=','mc.cat_id')
                  ->where("c.cat_id",'=',$category_id)
                  ->orderBy("{$this->table}.date",'desc')
                  ->remember(60)
                  ->select(array(
                                   "{$this->table}.movie_id",
                                   "{$this->table}.movie_url",
                                   "{$this->table}.title",
                                   "{$this->table}.time",
                                   "{$this->table}.plus",
                                   "{$this->table}.featured"
                ));

       return $movies->paginate($per_page); 

    }//get_all_movies_by_category_id_paginated


    public function get_all_movies_by_tag_id_paginated($tag_id,$per_page)
    {

      $movies = DB::table($this->table)
                  ->join('movie_tags as mt','mt.movie_id','=',"{$this->table}.movie_id")
                  ->join('tags as t','t.tag_id','=','mt.tag_id')
                  ->where("t.tag_id",'=',$tag_id)
                  ->orderBy("{$this->table}.date",'desc')
                  ->remember(60)
                  ->select(array(
                                   "{$this->table}.movie_id",
                                   "{$this->table}.movie_url",
                                   "{$this->table}.title",
                                   "{$this->table}.time",
                                   "{$this->table}.plus",
                                   "{$this->table}.featured"
                ));

       return $movies->paginate($per_page); 

    }//get_all_movies_by_tag_id_paginated

    public function search($search,$per_page)
    {

        $query = DB::table($this->table)
                   ->join('movie_categories as mc','mc.movie_id','=',"{$this->table}.movie_id")
                   ->join('categories as c','c.cat_id','=','mc.cat_id')
                   ->join('movie_tags as mt','mt.movie_id','=',"{$this->table}.movie_id")
                   ->join('tags as t','t.tag_id','=','mt.tag_id')
                   ->orderBy("{$this->table}.date", 'desc');


        if( $search != '' )
        {

            $query->where( function($query) use ($search)
            {

                $query->where("{$this->table}.title", 'LIKE', "%{$search}%");
                $query->OrWhere('c.name', 'LIKE', "%{$search}%");
                $query->OrWhere('t.name', 'LIKE', "%{$search}%");

            });//

            return $query->distinct()->paginate($per_page, array(
                                                                 "{$this->table}.movie_id",
                                                                 "{$this->table}.movie_url",
                                                                 "{$this->table}.title",
                                                                 "{$this->table}.time",
                                                                 "{$this->table}.plus",
                                                                 "{$this->table}.featured"
                                        ));


        }//if we need to search
        else {
                return DB::table($this->table)
                         ->orderBy("{$this->table}.date",'desc')
                         ->paginate($per_page, array(
                                                     "{$this->table}.movie_id",
                                                     "{$this->table}.movie_url",
                                                     "{$this->table}.title",
                                                     "{$this->table}.time",
                                                     "{$this->table}.plus",
                                                     "{$this->table}.featured"   
                    ));

        }//else return all

    }//search

}//end Movies