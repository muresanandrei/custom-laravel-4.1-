<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 8:40 PM
 */
namespace CoreApp\Website\Controllers\Frontend;

use \View, \App,\Event,\Response,\Input,\Request;

class Movie extends \Controller {


    public function single_movie($movie_id,$movie_url)
    {


        //GET Website Movies Model
        $website_movies_model = App::make('WebsiteMoviesModel');

        //Check if id exists
       if($website_movies_model->check_id_exists($movie_id) == false) return App::abort('404'); 


        //movie category model
        $movie_category_model = App::make('WebsiteMovieCategoryModel'); 

        //Movie comments model
        $movie_comments_model = App::make('MovieCommentsModel');

        //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');

        $movie = $website_movies_model->get_single_movie_by_id($movie_id)[0];

        //User ip model
        $user_ip_model = App::make('UserIpModel');

        //Get user ip to count views
        $ip = $_SERVER['REMOTE_ADDR'];

        $agent = $_SERVER["HTTP_USER_AGENT"];

        //add ip and increment views if ip doesn't exists for specified movie page
        if(!$user_ip_model->get_ip_by_movie_id($movie_id))
        {
            $user_ip_model->insert_ip($ip,$agent,$movie_id);

            $website_movies_model->increment_views_by_movie_id($movie_id);

        }//if there isn't an ip for the specified movie page


        //Format date 
        $date_format_object = new \SystemTools\Tools;

        $data = array(

                        'meta_description'          => $movie->meta_description,
                        'meta_keywords'             => $movie->meta_keywords,
                        'meta_title'                => $movie->title,
                        'movie'                     => $movie,
                        'ip'                        => $ip,
                        'date_format'               => $date_format_object,
                        'categories'                => $movie_category_model->all(),
                        'photo_categories'          => $photo_categories_model->all(),
                        'related_movies'            => $website_movies_model->related_movies_by_movie_categories($website_movies_model->get_movie_categoris_by_movie_id($movie_id),$movie_id),
                        'movie_tags'                => $website_movies_model->get_movie_tags_by_movie_id($movie_id),
                        'movie_cat'                 => $website_movies_model->get_movie_categoris_by_movie_id($movie_id),
                        'movie_comments_count'      => $movie_comments_model->count_comments_by_movie_id($movie_id),
                        'movie_comments'            => $movie_comments_model->get_movie_comment_by_status_and_movie_id($movie_id,10),
                        'current_page'              => 'movie'
        );
        

        //Load more comments
        if(Request::ajax())
        {       

   
                //If request ajax add more comments
                $data['movie_comments'] = $movie_comments_model->get_movie_comment_by_status_and_movie_id($movie_id, Input::get('add_comments')); 

                $html = View::make('CoreApp/Website/Views/Frontend/Movie/movie_comments_ajax', $data)->render();

                return Response::json(array('html' => $html));

        }//if request ajax   
      
        return View::make('CoreApp/Website/Views/Frontend/Movie/single_movie',$data);

    }//single_movie



    public function spank($movie_id)
    {
        //Spank model
        $spank_user_ip_model = App::make('UserIpSpankModel');

         //GET Website Movies Model
        $website_movies_model = App::make('WebsiteMoviesModel');

        //Get user ip to spank video
        $ip = $_SERVER['REMOTE_ADDR'];

        $agent = $_SERVER["HTTP_USER_AGENT"];

        //add ip and increment spanks if ip doesn't exists for specified movie page
        if(!$spank_user_ip_model->get_ip_by_movie_id($movie_id))
        {
            $spank_user_ip_model->insert_ip($ip,$agent,$movie_id);

            $website_movies_model->increment_spanks_by_movie_id($movie_id);

            return Response::json(['success' => true]);

        }//if there isn't an ip for the specified movie page
        else
        {
            return Response::json(['success' => false, 'error' => '<h4>Hold on there cowboy you\'ve already spanked this video once!</h4>']);
           
        }//else return spanked already 

    }//spanks

    public function comment($movie_id)
    {
        //Spank model
        $movie_comment_model = App::make('MovieCommentsModel');

        //Get user ip for movie comment
        $ip = $_SERVER['REMOTE_ADDR'];

        $inputs = array(

                        'name'      => Input::get('name'),
                        'comment'   => Input::get('comment')

        );

        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Movie(array(
                                                                            'name'     => $inputs['name'],
                                                                            'comment'  => $inputs['comment']
        ), 'movie_comment');

         /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {
             
                return Response::json(['success' => false,'error' => $validator->errors()->toArray()]);
             
        }//if validation didn't pass


        //add movie comment
        if($movie_comment_model->insert_comment($ip,$movie_id,$inputs['name'],$inputs['comment']))
        {

            //Mail about comment to admin
            mail('muresanandrei.web@gmail.com', 'Starfuck new comment', 'A new comment has been added by '.$inputs['name']);

            return Response::json(['success' => true]);

        }//if there isn't an ip for the specified movie page
        else
        {
            return Response::json(['error' => 400]);
           
        }//else return error 

    }//comment


    public function movies_by_category_id($category_id,$category_url)
    {
       
        //Get category model
        $category_model = App::make('WebsiteMovieCategoryModel');

        //Check if id exists
       if($category_model->check_category_id_exists($category_id) == false) return App::abort('404'); 

        //Get movies model
        $movies_model = App::make('WebsiteMoviesModel');

         //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');
        
        $category_movies = $movies_model->get_all_movies_by_category_id_paginated($category_id,20);

        //Category meta
        $category_meta = $category_model->get_category_by_id($category_id)[0];

        $data = array(

                        'category_id'                     => $category_id,
                        'category_movies'                 => $category_movies,
                        'meta_description'                => $category_meta->meta_description,
                        'meta_keywords'                   => $category_meta->meta_keywords,
                        'meta_title'                      => $category_meta->name,
                        'movies_paginate'                 => $category_movies->links(),
                        'last_5_featured_movies'          => $movies_model->get_latest_5_featured_movies(),
                        'categories'                      => $category_model->all(),
                        'photo_categories'                => $photo_categories_model->all(),
                        'current_page'                    => 'videos'
        );

        return View::make('CoreApp/Website/Views/Frontend/Movie/movies_category',$data);

    }//movies_by_category_id

    public function movies_by_tag_id($tag_id,$tag_url)
    {
       
        //Get tag model
        $tag_model = App::make('WebsiteMovieTagModel');

        //Check if id exists
       if($tag_model->check_tag_id_exists($tag_id) == false) return App::abort('404'); 

        //Get category model
        $category_model = App::make('WebsiteMovieCategoryModel');

        //Get movies model
        $movies_model = App::make('WebsiteMoviesModel');

        //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');
        
        $tag_movies = $movies_model->get_all_movies_by_tag_id_paginated($tag_id,20);

        //Category meta
        $tag_meta = $tag_model->get_tag_by_id($tag_id)[0];

        $data = array(

                        'tag_id'                          => $tag_id,
                        'tag_movies'                      => $tag_movies,
                        'meta_description'                => $tag_meta->meta_description,
                        'meta_keywords'                   => $tag_meta->meta_keywords,
                        'meta_title'                      => $tag_meta->name,
                        'movies_paginate'                 => $tag_movies->links(),
                        'last_5_featured_movies'          => $movies_model->get_latest_5_featured_movies(),
                        'categories'                      => $category_model->all(),
                        'photo_categories'                => $photo_categories_model->all(),
                        'current_page'                    => 'videos'
        );

        return View::make('CoreApp/Website/Views/Frontend/Movie/movies_tag',$data);

    }//movies_by_tag_id


    public function search()
    {

         //GET WebsitejournalModel
        $movie_model = App::make('WebsiteMoviesModel');

        //Get categories
        $category_model = App::make('WebsiteMovieCategoryModel');

        //All categories
        $categories = $category_model->all();

        //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');

        //Search
        $search = \Input::get('search');

        //Search results
        $search_result = $movie_model->search($search, 20);

         //Get meta
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $meta = $meta_pages_model->get_meta_by_id(3)[0];


        $data = array(
                        'meta_description'        => $meta->meta_description,
                        'meta_keywords'           => $meta->meta_keywords,
                        'meta_title'              => $meta->page_name,
                        'categories'              => $categories,
                        'photo_categories'        => $photo_categories_model->all(),
                        'last_5_featured_movies'  => $movie_model->get_latest_5_featured_movies(),
                        'search'                  => $search_result,
                        'search_name'             => $search,
                        'movies_paginate'         => $search_result->links(),
                        'current_page'            => 'search'
        );

        return View::make('CoreApp/Website/Views/Frontend/Movie/search',$data);

    }//journal_search

}//end Home