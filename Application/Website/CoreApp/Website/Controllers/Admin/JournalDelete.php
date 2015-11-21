<?php
/**
 * User: andrei
 * Date: 2/21/14
 * Time: 1:49 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \App,\Input,\DB,\Cache;

class JournalDelete extends \BaseControllers\Webrising
{

	function delete($id)
    {


        $return_data = array('error' => 1, 'message' => 'Journal could not be deleted please try again');


        //Get Blog Model
        $model_blog = App::make('WebsiteJournalModel');

        //Blog post category model
        $model_blog_post_category = App::make('WebsiteJournalPostCategoryModel');

        if( $model_blog->delete($id) && $model_blog_post_category->delete($id) )
        {

            $return_data['error'] = 0;
            $return_data['message'] = 'Journal has been deleted succesfully';


            //Flush cache
            Cache::flush();

        }//if the blog was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );

    }//delete


}//end class