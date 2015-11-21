<?php
/**
 * User: andrei
 * Date: 2/9/14
 * Time: 9:54 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input,\DB,\Image;

class JournalUpdate extends \Controller {


    public function update($journal_id)
    {

        //Website journal model
        $website_journal_model = App::make('WebsiteJournalModel');

        //Check if id exists
        if($website_journal_model->check_id_exists($journal_id) == false) return App::abort('404');

        //journal Category Model
        $journal_category_model = App::make('WebsiteJournalCategoryModel');

        //journal post category model
        $journal_post_category_model = App::make('WebsiteJournalPostCategoryModel');

        //Journal Tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        //Journal Tag post model
        $journal_post_tag_model = App::make('WebsiteJournalPostTagModel');

        $journal_post = $website_journal_model->get_post_by_journal_id($journal_id)[0];

        $data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'                            => trans('common.dashboard'),
                'admin/journal/all'                     => trans('common.journals'),
                'admin/journal/'.$journal_id.'/update'  => $journal_post->title,
                '!'                                     => trans('common.update')
            ),

              'journal_id'           => $journal_id,
              'categories'           => $journal_category_model->all(),
              'journal_post'         => $journal_post,
              'journal_category_id'  => $journal_post_category_model->get_category_id_by_journal_id($journal_id),
              'tags'                 => $journal_tag_model->all(),
              'journal_post_tags_id' => $journal_post_tag_model->get_tags_by_journal_id($journal_id)


        );


        return View::make('CoreApp/Website/Views/Backend/Journal/update',$data);

    }//update


    public function process_update($journal_id)
    {

        //Website journal model
        $website_journal_model = App::make('WebsiteJournalModel');

        //Check if id exists
        if($website_journal_model->check_id_exists($journal_id) == false) return App::abort('404');

        $inputs = array(

                        'meta_description'      => Input::get('meta_description'),
                        'meta_keywords'         => Input::get('meta_keywords'),
                        'post_url'              => Input::get('post_url'),
                        'category'              => (int)Input::get('category'),
                        'tags'                  => Input::get('tags'),
                        'title'                 => Input::get('title'),
                        'post'                  => Input::get('post'),
                        'main_journal_image'    => Input::file('main_journal_image'),
                        'featured'              => (int)Input::get('featured',1)

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

        ), 'update');


        /*
         * Check if the validation passes
         */
        if( ! $validator->passes() )
        {

            return \Redirect::to('admin/journal/'.$journal_id.'/update')->withErrors($validator->errors())->withInput();

        }//if validation didn't pass



        //journal post category model
        $journal_post_category_model = App::make('WebsiteJournalPostCategoryModel');

        //journal post tags model
        $journal_post_tag_model = App::make('WebsiteJournalPostTagModel');

        //Try to make the transaction
        try{

            DB::transaction(function() use($website_journal_model,$journal_post_category_model,$journal_id,$journal_post_tag_model,$inputs)
            {

                //GET journal image extension from database
                $journal_post = $website_journal_model->get_post_by_journal_id($journal_id)[0];

                
                //If Main journal image isset
                if(isset($inputs['main_journal_image'])) $main_journal_image_extension = $inputs['main_journal_image']->getClientOriginalExtension();


                //Get Main journal image extension for update from input if new picture is selected else same extension remains
                if( Input::file('main_journal_image') )
                {
                    $journal_image_extension = $inputs['main_journal_image']->getClientOriginalExtension();

                }//if new picture is selected
                else
                {

                    $journal_image_extension = $journal_post->journal_image_extension;

                }//else same picture extension remains


                //Update journal
                $website_journal_model->update_journal($journal_id,$inputs['meta_description'],$inputs['meta_keywords'],$inputs['post_url'],$inputs['title'],$inputs['post'],$journal_image_extension,$inputs['featured']);

               
                //Add journal post id category id to journal post categories
                $journal_post_category_model->update_journal_post_id_category_id($journal_post->id,$inputs['category']);


                //Delete tags then update with the new ones
                $journal_post_tag_model->delete_tags_by_journal_id($journal_id);

                //Update journal post tags
                $journal_tags = array();

                foreach($inputs['tags'] as $t)
                {

                        $journal_tags[] = array(    
                                                 'journal_post_id' => $journal_id,
                                                 'tag_id'          => (int)$t
                    );

                }//foreach tag

                $journal_post_tag_model->insert_journal_post_tags($journal_tags);

                //If new journal main image is added
                if( Input::file('main_journal_image') )
                {
                    /*
                     * Upload images
                     */

                    if(is_dir('cms/journal/'.$journal_id))
                    {

                        
                        if(is_file('cms/journal/'.$journal_id.'/journal_photo_medium/'.$journal_post->journal_image_extension)) {
                            unlink('cms/journal/'.$journal_id.'/journal_photo_medium/'.$journal_post->journal_image_extension);
                        }

                       
                        if(is_file('cms/journal/'.$journal_id.'/journal_photo_big/'.$journal_post->journal_image_extension)) {
                            unlink('cms/journal/'.$journal_id.'/journal_photo_big/'.$journal_post->journal_image_extension);
                        }

                        if(is_file('cms/journal/'.$journal_id.'/journal_photo_large/'.$journal_post->journal_image_extension)) {
                            unlink('cms/journal/'.$journal_id.'/journal_photo_large/'.$journal_post->journal_image_extension);
                        }

                    }//if has journal main picture


                        //Add main journal image
                        Input::file('main_journal_image')->move('cms/journal/'.$journal_id,'/'.$main_journal_image_extension);

                        Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 205,true)->save('cms/journal/'.$journal_id.'/journal_photo_medium.'.$main_journal_image_extension);

                        Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 374,true)->save('cms/journal/'.$journal_id.'/journal_photo_big.'.$main_journal_image_extension);

                        Image::make('cms/journal/'.$journal_id.'/'.$main_journal_image_extension)->resize(null, 566,true)->save('cms/journal/'.$journal_id.'/journal_photo_large.'.$main_journal_image_extension);

                        unlink('cms/journal/'.$journal_id.'/'.$main_journal_image_extension);

                }//if a new picture was added

            });//End transaction

        }//Try to make the transaction

            //Catch exception
        catch(\Exception $err){


            return \Redirect::to('admin/journal/'.$journal_id.'/update')->with('db_errors', true)->withInput();

        }//Catch exception


        //Flush cache
        \Cache::flush();

        /*
         * If we got here everything went good
         */
        return \Redirect::to('admin/journal/'.$journal_id.'/update')->with('success',true);

    }//process update

}//end JournalUpdate