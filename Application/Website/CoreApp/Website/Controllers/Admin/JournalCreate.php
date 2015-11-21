<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input,\DB,\Image;

class JournalCreate extends \BaseControllers\Webrising {


    public function create()
    {


        //journal Category Model
        $journal_category_model = App::make('WebsiteJournalCategoryModel');

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel'); 


        //Get all categories to see if there is atleast 1 else return to add category
        $categories = $journal_category_model->all();

        if($categories < 1) return \Redirect::to('admin/journal/category/create')->with('add_category',true);

        //Get all tags to see if there is atleast 1 else return to add tag
        $tags = $journal_tag_model->all();

        if($tags < 1) return \Redirect::to('admin/journal/tag/create')->with('add_tag',true);

               
        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                'admin/journal/all' => trans('common.journals'),
                '!'                 => trans('common.create')
            ),
                'categories'        => $categories,
                'tags'              => $tags
        );



        return View::make('CoreApp/Website/Views/Backend/Journal/create',$data);

    }//create


    public function process_create()
    {

        $inputs = array(

                        'meta_description'      => Input::get('meta_description'),
                        'meta_keywords'         => Input::get('meta_keywords'),
                        'post_url'              => Input::get('post_url'),
                        'category'              => (int)Input::get('category'),
                        'tags'                  => Input::get('tags'),
                        'title'                 => Input::get('title'),
                        'post'                  => Input::get('post'),
                        'main_journal_image'    => Input::file('main_journal_image'),
                        'featured'              => (int)Input::get('featured',1),

        );

        /*
        * Validate customer
        */
        $validator = new \CoreApp\Website\Validations\Journal(array(
                                                                            'meta_description'     => $inputs['meta_description'],
                                                                            'meta_keywords'        => $inputs['meta_keywords'],
                                                                            'post_url'             => $inputs['post_url'],
                                                                            'category'             => $inputs['category'],
                                                                            'journal_tag'          => $inputs['tags'],
                                                                            'title'                => $inputs['title'],
                                                                            'post'                 => $inputs['post'],
                                                                            'main_journal_image'   => $inputs['main_journal_image'],

        ), 'create');


        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/create')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass




        //journal model
        $journal_model = App::make('WebsiteJournalModel');


        //journal post category model
        $journal_post_category_model = App::make('WebsiteJournalPostCategoryModel');

        //journal post tags model
        $journal_post_tag_model = App::make('WebsiteJournalPostTagModel');


        //Try to make the transaction
        try{

            DB::transaction(function() use($journal_model,$journal_post_category_model,$journal_post_tag_model,$inputs)
            {
                
                //Main journal image extension
                $main_journal_image_extension = $inputs['main_journal_image']->getClientOriginalExtension();

                //Insert get id
                $journal_id = $journal_model->insert_journal_get_id($inputs['meta_description'],$inputs['meta_keywords'],$inputs['post_url'],$inputs['title'],$inputs['post'],$main_journal_image_extension,$inputs['featured']);

                
                 //Add main journal image
                Input::file('main_journal_image')->move('cms/journal/'.$journal_id,'/'.$main_journal_image_extension);

                Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 205,true)->save('cms/journal/'.$journal_id.'/journal_photo_medium.'.$main_journal_image_extension);

                Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 374,true)->save('cms/journal/'.$journal_id.'/journal_photo_big.'.$main_journal_image_extension);

                Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 566,true)->save('cms/journal/'.$journal_id.'/journal_photo_large.'.$main_journal_image_extension);

                unlink('cms/journal/'.$journal_id.'/'.$main_journal_image_extension);


                //Add journal post id category id to journal post categories
                $journal_post_category_model->insert_journal_post_id_category_id($journal_id,$inputs['category']);


                //Insert batch journal post tags
                $journal_tags = array();

                foreach($inputs['tags'] as $t)
                {

                    $journal_tags[] = array(
                                                'journal_post_id'      => $journal_id,
                                                'tag_id'               => (int)$t
                    );


                }//foreach tag

                $journal_post_tag_model->insert_journal_post_tags($journal_tags);

            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/create')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/all');

    }//process create

}//end journal