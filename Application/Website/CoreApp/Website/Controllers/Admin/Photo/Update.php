<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Photo;

use \View, \App,\Input,\DB,\Image,\Response;

class Update extends \BaseControllers\Webrising {


    public function update($id)
    {

        //Photos model
        $photos_categories_model = App::make('WebsitePhotosCategoriesModel');

        //Check if id exists
        if($photos_categories_model->check_id_exists($id) == false) return App::abort('404');

        $data = array(
            'page_title'  => trans('common.photo'),
            'breadcrumbs' => array(
                'admin/home'                        => trans('common.dashboard'),
                'admin/movie/all'                   => trans('common.photos'),
                '!'                                 => trans('common.update')
            ),
                'id'                    => $id
        );


        return View::make('CoreApp/Website/Views/Backend/Photo/update',$data);

    }//update


    public function images($id)
    {
        //Path to movie thumbnails
        $path = 'photo_gallery/'.$id.'/';

        //Filter array to remove . and ..
        $files = array_filter(scandir($path), function($item) use ($id) {

            return !is_dir("photo_gallery/".$id.'/'.$item);
        });


        foreach($files as $file) //get an array which has the names of all the files and loop through it 
        { 
            $obj['name'] = $file; //get the filename in array
            $obj['size'] = filesize("photo_gallery/".$id.'/'.$file); //get the flesize in array
            $result[] = $obj; // copy it to another array
        }

       header('Content-Type: application/json');
       echo json_encode($result); // now you have a json response which you can use in client side 

    }//get images


}//end Update