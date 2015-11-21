<?php
/**
 * User: andrei
 * Date: 2/9/14
 * Time: 1:30 AM
 */
namespace CoreApp\Website\Validations;

class Journal extends \Abstracts\Validation {


    public $rules = array(

        'create' => array(

                            'meta_description'     => 'required|max:200',
                            'meta_keywords'        => 'required|max:200',
                            'post_url'             => 'required|max:500',
                            'category'             => 'not_in:0',
                            'journal_tag'          => 'required|not_in:0',
                            'title'                => 'required|max:255',
                            'post' 	               => 'required|',
                            'main_journal_image'   => 'required|mimes:jpeg,bmp,png,jpg|max:10000'


        ),
        'update' => array(

                            'meta_description'     => 'required|max:200',
                            'meta_keywords'        => 'required|max:200',
                            'post_url'             => 'required|max:500',
                            'category'             => 'not_in:0',
                            'journal_tag'          => 'required|not_in:0',
                            'title'                => 'required|max:255',
                            'post' 	               => 'required|',
                            'main_journal_image'   => 'mimes:jpeg,bmp,png,jpg|max:10000'

        ),
        'create_journal_tag' => array(

                                        'meta_description'          => 'required|max:200',
                                        'meta_keywords'             => 'required|max:200',
                                        'tag_url'                   => 'required|max:500',
                                        'tag_name'                  => 'required|max:255'
        ),
        'update_journal_tag' => array(

                                        'meta_description'          => 'required|max:200',
                                        'meta_keywords'             => 'required|max:200',
                                        'tag_url'                   => 'required|max:500',
                                        'tag_name'                  => 'required|max:255'
        ),
        'journal_category_create' => array(
                                            'meta_description'              => 'required|max:200',
                                            'meta_keywords'                 => 'required|max:200',
                                            'category_url'                  => 'required|max:500',
                                            'category_name'                 => 'required|max:255'
        ),
        'journal_category_update' => array(

                                            'meta_description'              => 'required|max:200',
                                            'meta_keywords'                 => 'required|max:200',
                                            'category_url'                  => 'required|max:500',
                                            'category_name'                 => 'required|max:255'
        )                              


    );


}//class Journal