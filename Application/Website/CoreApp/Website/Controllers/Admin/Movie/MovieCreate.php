<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \View, \App,\Input,\DB,\Image,\Response;

class MovieCreate extends \BaseControllers\Webrising {


    public function create()
    {


        //Movie Category Model
        $website_movie_category_model = App::make('WebsiteMovieCategoryModel');

        //Movie tag model
        $website_movie_tag_model = App::make('WebsiteMovieTagModel'); 


        //Get all categories to see if there is atleast 1 else return to add movie category
        $categories = $website_movie_category_model->all();

        if($categories < 1) return \Redirect::to('admin/movie/category/create')->with('add_category',true);

        //Get all tags to see if there is atleast 1 else return to add tag
        $tags = $website_movie_tag_model->all();

        if($tags < 1) return \Redirect::to('admin/movie/tag/create')->with('add_tag',true);

               
        $data = array(
            'page_title'  => trans('common.movie'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                'admin/movie/all'   => trans('common.movies'),
                '!'                 => trans('common.create')
            ),
                'categories'        => $categories,
                'tags'              => $tags
        );



        return View::make('CoreApp/Website/Views/Backend/Movie/create',$data);

    }//create


    public function process_create()
    {

        $inputs = array(

                        'meta_description'      => Input::get('meta_description'),
                        'meta_keywords'         => Input::get('meta_keywords'),
                        'movie_url'             => Input::get('movie_url'),
                        'categories'            => Input::get('categories'),
                        'tags'                  => Input::get('tags'),
                        'title'                 => Input::get('title'),
                        'time'                  => Input::get('time'),
                        'views'                 => Input::get('views'),
                        'description'           => Input::get('description'),
                        'embed_code'            => Input::get('embed_code'),
                        'featured'              => (int)Input::get('featured',1),
                        
        );

        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Movie(array(
                                                                            'meta_description'     => $inputs['meta_description'],
                                                                            'meta_keywords'        => $inputs['meta_keywords'],
                                                                            'movie_url'            => $inputs['movie_url'],
                                                                            'categories'           => $inputs['categories'],
                                                                            'tags'                 => $inputs['tags'],
                                                                            'title'                => $inputs['title'],
                                                                            'time'                 => $inputs['time'],
                                                                            'views'                => $inputs['views'],
                                                                            'description'          => $inputs['description'],
                                                                            'embed_code'           => $inputs['embed_code']

        ), 'create');


 
            
        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {
             
                 return \Redirect::to('admin/movie/create')->withErrors($validator->errors())->withInput();
             
        }//if validation didn't pass
        

        $movie_model = App::make('WebsiteMoviesModel');

        $movie_categories_model = App::make('WebsiteMovieCategoriesModel');

        $movie_tags_model = App::make('WebsiteMovieTagsModel'); 


        //Try to make the transaction
        try{

            DB::transaction(function() use($movie_model,$movie_categories_model,$movie_tags_model,$inputs)
            {
         
                
                //GET movie id
                $movie_id = $movie_model->insert_movie_get_id($inputs['meta_description'],$inputs['meta_keywords'],
                            $inputs['movie_url'],$inputs['embed_code'],$inputs['title'],$inputs['description'],$inputs['time'],
                            $inputs['views'],$inputs['featured']);

                //Store movie id for thumbnail images
                \Session::flash('movie_id',$movie_id);


                //Insert batch movie categories
                $movie_categories = array();

                foreach($inputs['categories'] as $c)
                {

                    $movie_categories[] = array(

                                                    'movie_id'  => (int)$movie_id,
                                                    'cat_id'    => (int)$c
                        );

                }//foreach category

                $movie_categories_model->insert_movie_categories($movie_categories);


                //Insert batch movie tags
                $movie_tags = array();

                foreach($inputs['tags'] as $t)
                {

                    $movie_tags[] = array(
                                                'tag_id'               => (int)$t,
                                                'movie_id'             => $movie_id,
                    );


                }//foreach tag

                $movie_tags_model->insert_movie_tags($movie_tags);

              
            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){

            return \Redirect::to('admin/movie/create')->with('db_errors', true)->withInput();

        }//Catch exception
    


        //Flush cache
        \Cache::flush();

    
        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/movie/create')->with('movie_success',true);


    }//process create

    public function thumbnails($movie_id)
    {
        
        $file = \Input::file('thumbnails_images');
      
        if($file) {

        foreach($file as $f)
        {
            //Image name
            $imageName = $f->getClientOriginalName();


            $f->move('movies_images/'.$movie_id, '/'.$imageName);

            Image::make('movies_images/'.$movie_id.'/'.$imageName)->resize(400, 267,false)->save('movies_images/'.$movie_id.'/'.$imageName);

        }//foreach file

 
            return Response::json(['success' => true ]);
        }//return sucess 
        else {
            return Response::json('error', 400);
        }//else return error
    

    }//thumbnails

}//end movie