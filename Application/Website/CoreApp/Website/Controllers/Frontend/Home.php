<?php

/**
 * User: andrei
 * Date: 08/11/14
 * Time: 18:07 AM
 */
namespace CoreApp\Website\Controllers\Frontend;

use \View,\App;

class Home extends \Controller {


    public function index()
    {

		//Get meta
		$meta_pages_model = App::make('WebsiteMetaPagesModel');

        //Get movies
        $movies_model = App::make('WebsiteMoviesModel');

        //Get categories
        $category_model = App::make('WebsiteMovieCategoryModel');

        //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');

        $categories = $category_model->all();


        $movies = $movies_model->get_all_movies_paginated(20);

		$meta = $meta_pages_model->get_meta_by_id(1)[0];

    	$data = array(

    					'meta_description' 	      => $meta->meta_description,
    					'meta_keywords'		      => $meta->meta_keywords,
                        'meta_title'              => $meta->page_name,
                        'current_page'            => 'home',
                        'categories'              => $categories,
                        'last_5_featured_movies'  => $movies_model->get_latest_5_featured_movies(),
                        'movies'                  => $movies,
                        'photo_categories'        => $photo_categories_model->all(),
                        'movies_paginate'         => $movies->links()

    				 );

        return View::make('CoreApp/Website/Views/Frontend/home',$data);

    }//index

}//end Home