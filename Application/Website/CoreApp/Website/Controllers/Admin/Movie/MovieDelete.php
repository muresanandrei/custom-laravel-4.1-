<?php
/**
 * User: andrei
 * Date: 8/19/14
 * Time: 1:49 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \App,\Input,\DB,\Cache;

class MovieDelete extends \BaseControllers\Webrising
{

	function delete($id)
    {

        $return_data = array('error' => 1, 'message' => 'Movie could not be deleted please try again');

        //Get Movie Model
        $movie_model = App::make('WebsiteMoviesModel');

        //Movie categories model
        $movie_categories_model = App::make('WebsiteMovieCategoriesModel');

        //Movie tags model
        $movie_tags_model = App::make('WebsiteMovieTagsModel');

        if( $movie_model->delete($id) && $movie_categories_model->delete($id) && $movie_tags_model->delete($id))
        {

            //System Tools
            $tools = new \SystemTools\Tools;

            $tools->rrmdir('movies_images/'.$id);

            $return_data['error'] = 0;
            $return_data['message'] = 'Movie has been deleted succesfully';


            //Flush cache
            Cache::flush();

        }//if the movie was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );

    }//delete


}//end class