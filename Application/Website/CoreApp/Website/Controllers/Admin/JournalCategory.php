<?php
/**
 * User: andrei
 * Date: 4/14/14
 * Time: 7:14 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input,\DB,\Image;

class JournalCategory extends \BaseControllers\Webrising {


    public function create()
    {


        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'               => trans('common.dashboard'),
                'admin/journal/categories' => trans('common.journal_categories'),
                '!'                        => trans('common.create')
            ),
            
        );



        return View::make('CoreApp/Website/Views/Backend/JournalCategory/create',$data);

    }//create


    public function process_create()
    {

        $inputs = array(
                        'meta_description'              => Input::get('meta_description'),
                        'meta_keywords'                 => Input::get('meta_keywords'),
                        'category_url'                  => Input::get('category_url'),
                        'category_name'                 => Input::get('category_name')

        );


        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Journal(array(
                                                                    'meta_description'              => $inputs['meta_description'],
                                                                    'meta_keywords'                 => $inputs['meta_keywords'],
                                                                    'category_url'                  => $inputs['category_url'],
                                                                    'category_name'                 => $inputs['category_name'],

             'journal_category_create'));

        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/category/create')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass


        //journal category model
        $journal_category_model = App::make('WebsiteJournalCategoryModel');



        //Try to make the transaction
        try{

            DB::transaction(function() use($journal_category_model,$inputs)
            {
                
                //Insert Journal Category
                $journal_category_id = $journal_category_model->insert_journal_category_get_id($inputs['meta_description'],$inputs['meta_keywords'],$inputs['category_url'],$inputs['category_name']);

            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/category/create')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/categories');

    }//process create



    public function update($category_id)
    {

        //Journal tag model
        $journal_category_model = App::make('WebsiteJournalCategoryModel');

        //Check if id exists
        if($journal_category_model->check_id_exists($category_id) == false) return App::abort('404');
    
        $category = $journal_category_model->get_category_by_id($category_id)[0];

        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'                                     => trans('common.dashboard'),
                'admin/journal/categories'                       => trans('common.journal_categories'),
                'admin/journal/category/'.$category_id.'/update' => $category->name,
                '!'                                              => trans('common.update')
            ),

                'category_id'        => $category_id,
                'category'           => $category
            
        );


        return View::make('CoreApp/Website/Views/Backend/JournalCategory/update',$data);

    }//update


    public function process_update($category_id)
    {


        //Journal category model
        $journal_category_model = App::make('WebsiteJournalCategoryModel');

        //Check if id exists
        if($journal_category_model->check_id_exists($category_id) == false) return App::abort('404');

        $inputs = array(
                        'meta_description'              => Input::get('meta_description'),
                        'meta_keywords'                 => Input::get('meta_keywords'),
                        'category_url'                  => Input::get('category_url'),
                        'category_name'                 => Input::get('category_name')

        );


        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Journal(array(
                                                                    'meta_description'               => $inputs['meta_description'],
                                                                    'meta_keywords'                  => $inputs['meta_keywords'],
                                                                    'category_url'                   => $inputs['category_url'],
                                                                    'category_name'                  => $inputs['category_name'],
                                                                    'journal_category_update'));

        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/category/'.$category_id.'/update')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass



        //Try to make the transaction
        try{

            DB::transaction(function() use($category_id,$journal_category_model,$inputs)
            {

                //Update Journal Category
                $journal_category_model->update_category($category_id,$inputs['meta_description'],$inputs['meta_keywords'],$inputs['category_url'],$inputs['category_name']);


            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/category/'.$category_id.'/update')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/category/'.$category_id.'/update')->with('success',true);

    }//process update


    public function all()
    {


        //GET WebsitejournalCategoryModel
        $journal_category_model = App::make('WebsiteJournalCategoryModel');


        $categories = $journal_category_model->get_all_categories_paginated(100);


        $data = array(
            'page_title'  => trans('common.journal_categories'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'                 => trans('common.journal_categories'),

            ),
                'categories'             => $categories,
                'paginate_links'         => $categories->links()
        );


        return View::make('CoreApp/Website/Views/Backend/JournalCategory/all',$data);

    }//all


    function delete($id)
    {


        $return_data = array('error' => 1, 'message' => 'Category could not be deleted please try again');


        //Get Journal Category Model
        $model_category = App::make('WebsiteJournalCategoryModel');


        if( $model_category->delete($id))
        {

            $return_data['error'] = 0;
            $return_data['message'] = 'Category has been deleted succesfully';


            //Flush cache
            \Cache::flush();

        }//if the category was deleted


        /*
         * If we got this far, everything is ok
         */
        return \Response::json( $return_data );

    }//delete

}//end JournalTag