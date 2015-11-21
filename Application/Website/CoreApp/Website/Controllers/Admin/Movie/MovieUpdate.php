<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \View, \App,\Input,\DB,\Image,\Response;

class MovieUpdate extends \BaseControllers\Webrising {


    public function update($movie_id)
    {

        //Movie model
        $movie_model = App::make('WebsiteMoviesModel');

        //Check if id exists
        if($movie_model->check_id_exists($movie_id) == false) return App::abort('404');

        //Movie Category Model
        $website_movie_category_model = App::make('WebsiteMovieCategoryModel');

        //Movie tag model
        $website_movie_tag_model = App::make('WebsiteMovieTagModel'); 

         //Movie Categories Model
        $movie_categories_model = App::make('WebsiteMovieCategoriesModel');

         //Movie Tags model
        $movie_tags_model = App::make('WebsiteMovieTagsModel');

        
        //Get categories id
        $cat_result = array();

        foreach ($movie_categories_model->get_categories_id_by_movie_id($movie_id) as $key => $value)
        {
                $cat_result[] = $value->cat_id;

        }//foreach categories

        //Movie
        $movie = $movie_model->get_movie_by_id($movie_id)[0];

        $data = array(
            'page_title'  => trans('common.movie'),
            'breadcrumbs' => array(
                'admin/home'                        => trans('common.dashboard'),
                'admin/movie/all'                   => trans('common.movies'),
                'admin/movie/'.$movie_id.'/update'  => $movie->title,
                '!'                                 => trans('common.update')
            ),
                'movie_id'              => $movie_id,
                'movie'                 => $movie,
                'categories'            => $website_movie_category_model->all(),
                'tags'                  => $website_movie_tag_model->all(),
                'movie_categories_id'   => $cat_result,
                'movie_tags_id'         => $movie_tags_model->get_tags_by_movie_id($movie_id)

        );


        return View::make('CoreApp/Website/Views/Backend/Movie/update',$data);

    }//update


    public function images($movie_id)
    {
        //Path to movie thumbnails
        $path = 'movies_images/'.$movie_id.'/';

        //Filter array to remove . and ..
        $files = array_filter(scandir($path), function($item) use ($movie_id) {

            return !is_dir("movies_images/".$movie_id.'/'.$item);
        });


        foreach($files as $file) //get an array which has the names of all the files and loop through it 
        { 
            $obj['name'] = $file; //get the filename in array
            $obj['size'] = filesize("movies_images/".$movie_id.'/'.$file); //get the flesize in array
            $result[] = $obj; // copy it to another array
        }

       header('Content-Type: application/json');
       echo json_encode($result); // now you have a json response which you can use in client side 

    }//get movie images


    public function process_update($movie_id)
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

        ), 'update');


 
            
        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {
             
                return Response::json(['success' => false,'error' => $validator->errors()->toArray()]);
             
        }//if validation didn't pass
        

        $movie_model = App::make('WebsiteMoviesModel');

        $movie_categories_model = App::make('WebsiteMovieCategoriesModel');

        $movie_tags_model = App::make('WebsiteMovieTagsModel'); 


        //Try to make the transaction
        try{

            DB::transaction(function() use($movie_id,$movie_model,$movie_categories_model,$movie_tags_model,$inputs)
            {
         
                //Update movie
                 $movie_model->update_movie($movie_id,$inputs['meta_description'],$inputs['meta_keywords'],
                            $inputs['movie_url'],$inputs['embed_code'],$inputs['title'],$inputs['description'],$inputs['time'],
                            $inputs['views'],$inputs['featured']);



                 //Delete categories than insert new ones
                 $movie_categories_model->delete($movie_id);

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



                 //Delete tags than insert new ones
                 $movie_tags_model->delete($movie_id);

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

            return Response::json('error', 400);

        }//Catch exception
    


        //Flush cache
        \Cache::flush();


        /*
         * If we got here everything went good
         */
        return Response::json(['success' => true]);


    }//process update

}//end movie