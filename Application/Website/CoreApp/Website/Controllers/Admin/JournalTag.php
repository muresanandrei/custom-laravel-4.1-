<?php
/**
 * User: andrei
 * Date: 3/24/14
 * Time: 9:46 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input,\DB,\Image;

class JournalTag extends \BaseControllers\Webrising {


    public function create()
    {


        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'         => trans('common.dashboard'),
                'admin/journal/tags' => trans('common.journal_tags'),
                '!'                  => trans('common.create')
            ),
            
        );



        return View::make('CoreApp/Website/Views/Backend/JournalTag/create',$data);

    }//create


    public function process_create()
    {

        $inputs = array(

                        'meta_description'         => Input::get('meta_description'),
                        'meta_keywords'            => Input::get('meta_keywords'),
                        'tag_url'                  => Input::get('tag_url'),
                        'tag_name'                 => Input::get('tag_name')

        );


        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Journal(array(
                                                                    'meta_description'               => $inputs['meta_description'],
                                                                    'meta_keywords'                  => $inputs['meta_keywords'],
                                                                    'tag_url'                        => $inputs['tag_url'],
                                                                    'tag_name'                       => $inputs['tag_name'],
                'create_journal_tag'));

        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/tag/create')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass



        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');


        //Try to make the transaction
        try{

            DB::transaction(function() use($journal_tag_model,$inputs)
            {

                
                //Insert Journal Tag
                $tag_id = $journal_tag_model->insert_journal_tag_get_id($inputs['meta_description'],$inputs['meta_keywords'],$inputs['tag_url'],$inputs['tag_name']);

 
            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/tag/create')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/tags');

    }//process create



    public function update($tag_id)
    {

        //Journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        //Check if id exists
        if($journal_tag_model->check_id_exists($tag_id) == false) return App::abort('404');
    
        $tag = $journal_tag_model->get_tag_by_id($tag_id)[0];

        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'                           => trans('common.dashboard'),
                'admin/journal/tags'                   => trans('common.journal_tags'),
                'admin/journal/tag/'.$tag_id.'/update' => $tag->name,
                '!'                                    => trans('common.update')
            ),

                'tag_id'        => $tag_id,
                'tag'           => $tag
            
        );


        return View::make('CoreApp/Website/Views/Backend/JournalTag/update',$data);

    }//update


    public function process_update($tag_id)
    {

        //Journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        //Check if id exists
        if($journal_tag_model->check_id_exists($tag_id) == false) return App::abort('404');

        $inputs = array(

                        'meta_description'          => Input::get('meta_description'),
                        'meta_keywords'             => Input::get('meta_keywords'),
                        'tag_url'                   => Input::get('tag_url'),
                        'tag_name'                  => Input::get('tag_name')

        );


        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Journal(array(
                                                                    'meta_description'          => $inputs['meta_description'],
                                                                    'meta_keywords'             => $inputs['meta_keywords'],
                                                                    'tag_url'                   => $inputs['tag_url'],
                                                                    'tag_name'                  => $inputs['tag_name'],
                                                                    'update_journal_tag'));

        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/tag/'.$tag_id.'/update')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass



        //Try to make the transaction
        try{

            DB::transaction(function() use($tag_id,$journal_tag_model,$inputs)
            {


                //Update Journal Tag
                $journal_tag_model->update_tag($tag_id,$inputs['meta_description'],$inputs['meta_keywords'],$inputs['tag_url'],$inputs['tag_name']);

                
            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/tag/'.$tag_id.'/update')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/tag/'.$tag_id.'/update')->with('success',true);

    }//process create


    public function all()
    {


        //GET WebsitejournalModel
        $journal_tag_model = App::make('WebsiteJournalTagModel');


        $tags = $journal_tag_model->get_all_tags_paginated(500);

        $data = array(
            'page_title'  => trans('common.journal_tags'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'                 => trans('common.journal_tags'),

            ),
                'tags'             => $tags,
                'paginate_links'   => $tags->links()
        );


        return View::make('CoreApp/Website/Views/Backend/JournalTag/all',$data);

    }//all


    function delete($id)
    {


        $return_data = array('error' => 1, 'message' => 'Tag could not be deleted please try again');


        //Get Blog Model
        $model_tag = App::make('WebsiteJournalTagModel');


        if( $model_tag->delete($id))
        {

            $return_data['error'] = 0;
            $return_data['message'] = 'Tag has been deleted succesfully';


            //Flush cache
            \Cache::flush();

        }//if the tag was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );

    }//delete

}//end JournalTag