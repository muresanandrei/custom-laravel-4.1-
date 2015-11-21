<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \App,\Input,\Request,\Response;

class MovieDropzoneDelete extends \BaseControllers\Webrising {


    public function movie_thumbnails($movie_id)
    {

        $file = Input::get('id');

       if($file) {


                unlink('movies_images/'.$movie_id.'/'.$file);

            return Response::json(['delete' => true ]);
        }//return sucess 
        else {
            return Response::json('error', 400);
        }//else return error
    

    }//thumbnails

}//end movie