<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \View, \App,\Input;

class MovieAll extends \Controller
{

	public function all()
	{


        //GET WebsitejournalModel
        $website_movie_model = App::make('WebsiteMoviesModel');


        $movies = $website_movie_model->get_all_movies();

		$data = array(
            'page_title'  => trans('common.movie'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'    				=> trans('common.movies'),

            ),
                'movies'             => $movies
        );



        return View::make('CoreApp/Website/Views/Backend/Movie/all',$data);

	}//all


}//end class