<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Photo;

use \View, \App,\Input;

class All extends \Controller
{

	public function all()
	{


        //GET photos categories
        $photo_category_model = App::make('WebsitePhotosCategoriesModel');


		$data = array(
            'page_title'  => trans('common.movie'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'    				=> trans('common.movies'),

            ),
                'photo_categories'             => $photo_category_model->all()
        );



        return View::make('CoreApp/Website/Views/Backend/Photo/all',$data);

	}//all


}//end class