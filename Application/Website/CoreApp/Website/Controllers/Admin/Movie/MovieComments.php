<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin\Movie;

use \View, \App,\Input,\Response;

class MovieComments extends \Controller
{

	public function comments()
	{


        //GET Movies comments model
        $movies_comments_model = App::make('MovieCommentsModel');


		$data = array(
            'page_title'  => trans('common.movie'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'    				=> trans('common.movie_comments'),

            ),
                'movies_comments'    => $movies_comments_model->get_all_comments()
        );



        return View::make('CoreApp/Website/Views/Backend/Movie/comments',$data);

	}//all

    public function approve($comment_id)
    {

        //GET Movies comments model
        $movies_comments_model = App::make('MovieCommentsModel');

         //add ip and increment spanks if ip doesn't exists for specified movie page
        if($movies_comments_model->approve($comment_id))
        {

            return Response::json(['success' => true]);

        }//if approved
        else
        {
            return Response::json(['success' => false]);
           
        }//else return error 

    }//approve


    public function disable($comment_id)
    {

        //GET Movies comments model
        $movies_comments_model = App::make('MovieCommentsModel');

         //add ip and increment spanks if ip doesn't exists for specified movie page
        if($movies_comments_model->disable($comment_id))
        {

            return Response::json(['success' => true]);

        }//if approved
        else
        {
            return Response::json(['success' => false]);
           
        }//else return error 

    }//disable


    public function delete($comment_id)
    {

        $return_data = array('error' => 1, 'message' => 'Movie comment could not be deleted please try again');

        //Get Movie Model
        $movie_comment_model = App::make('MovieCommentsModel');


        if( $movie_comment_model->delete($comment_id))
        {


            $return_data['error'] = 0;
            $return_data['message'] = 'Movie comment has been deleted succesfully';

        }//if the movie was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );


    }//delete


}//end class