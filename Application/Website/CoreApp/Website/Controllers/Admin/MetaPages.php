<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 2/21/14
 * Time: 12:25 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input,\DB;

class MetaPages extends \BaseControllers\Webrising
{

    public function all()
    {

        //Meta Pages Model
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $data = array(
            'page_title'  => trans('common.meta_pages'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'                 => trans('common.meta_pages')
            ),
                'meta_pages'        => $meta_pages_model->all()
        );



        return View::make('CoreApp/Website/Views/Backend/Meta/all',$data);

    }//all


    public function update($page_id)
    {

        //Meta Pages Model
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $meta = $meta_pages_model->get_meta_by_id($page_id)[0];

        $data = array(
            'page_title'  => trans('common.meta_pages'),
            'breadcrumbs' => array(
                'admin/home'                          => trans('common.dashboard'),
                'admin/meta_pages/all'                => trans('common.meta_pages'),
                'admin/meta_page/'.$page_id.'/update' => $meta->page_name,
                '!'                                   => trans('common.update')
            ),
                'meta'          => $meta
        );



        return View::make('CoreApp/Website/Views/Backend/Meta/update',$data);

    }//update


    public function process_update($page_id)
    {


         $inputs = array(

                        'meta_description'              => Input::get('meta_description'),
                        'meta_keywords'                 => Input::get('meta_keywords')

        );

        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Meta(array(
                                                                    'meta_description'    => $inputs['meta_description'],
                                                                    'meta_keywords'       => $inputs['meta_keywords']


        ), 'update');


        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/meta_page/'.$page_id.'/update')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass


        //Meta Pages Model
        $meta_pages_model = App::make('WebsiteMetaPagesModel');


        
    //Try to make the transaction
        try{

             DB::transaction(function() use($meta_pages_model,$page_id,$inputs)
             {
                $meta_pages_model->update_meta($page_id,$inputs['meta_description'],$inputs['meta_keywords']);
        
             });//End transaction

            }//Try to make the transaction

        //Catch exception
        catch(\Exception $err){

            return \Redirect::to('admin/meta_page/'.$page_id.'/update')->with('db_errors',true)->withInput();

        }//if validation didn't pass
        

        return \Redirect::to('admin/meta_page/'.$page_id.'/update')->with('success',true);

    }//all



}//End class