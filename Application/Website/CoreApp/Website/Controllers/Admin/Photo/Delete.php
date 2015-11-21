<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Photo;

use \App,\Input,\Request,\Response;

class Delete extends \BaseControllers\Webrising {


    public function delete($cat_id)
    {

        $file = Input::get('id');

       if($file) {


                unlink('photo_gallery/'.$cat_id.'/'.$file);

            return Response::json(['delete' => true ]);
        }//return sucess 
        else {
            return Response::json('error', 400);
        }//else return error
    

    }//delete

    function delete_photo_category($id)
    {

        $return_data = array('error' => 1, 'message' => 'Photo category could not be deleted please try again');

        //GET photos categories
        $photo_category_model = App::make('WebsitePhotosCategoriesModel');


        if( $photo_category_model->delete($id))
        {

            //System Tools
            $tools = new \SystemTools\Tools;

            $tools->rrmdir('photo_gallery/'.$id);

            $return_data['error'] = 0;
            $return_data['message'] = 'Photo category has been deleted succesfully';


        }//if the photo category was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );

    }//delete_photo_category

}//end Photo