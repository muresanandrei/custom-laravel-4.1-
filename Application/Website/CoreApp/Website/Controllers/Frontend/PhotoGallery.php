<?php
/**
 * User: andrei
 * Date: 2/4/14
 * Time: 11:04 PM
 */
namespace CoreApp\Website\Controllers\Frontend;

use \View,\App;

class PhotoGallery extends \Controller {


    public function index($id,$url)
    {

    	 //Photo categories model
        $photo_categories_model = App::make('WebsitePhotosCategoriesModel');

         //Check if id exists
        if($photo_categories_model->check_id_exists($id) == false) return App::abort('404');

        $meta = $photo_categories_model->get_photo_gallery_meta_by_id($id)[0];

        //Get categories
        $category_model = App::make('WebsiteMovieCategoryModel');

        //Path to photos
        $path = 'photo_gallery/'.$id.'/';

        //Filter array to remove . and ..
        $files = array_filter(scandir($path), function($item) use ($id) {

            return !is_dir("photo_gallery/".$id.'/'.$item);
        });

        //Results array
        $result = array();

        foreach($files as $file) //get an array which has the names of all the files and loop through it 
        { 
            $obj['name'] = $file; //get the filename in array
            $obj['path'] = \Request::root().'/photo_gallery/'.$id.'/'.$file;//path
            $result[] = $obj; // copy it to another array

        }//foreach file


        $data = array(

                        'meta_description'  => $meta->meta_description,
                        'meta_keywords'     => $meta->meta_keywords,
                        'meta_title'        => $meta->name,
                        'categories'        => $categories = $category_model->all(),
                        'photo_categories'  => $photo_categories_model->all(),
                        'photos'            => $result,
                        'current_page'      => 'photo_gallery'

                     );

        return View::make('CoreApp/Website/Views/Frontend/Photo/index',$data);

    }//index

}//end Home