<?php
/**
 * User: andrei
 * Date: 14/09/14
 * Time: 18:05 AM
 */
namespace CoreApp\Website\Validations;

class Movie extends \Abstracts\Validation {


    public $rules = array(

        'create' => array(

                            'meta_description'     => 'required|max:200',
                            'meta_keywords'        => 'required|max:200',
                            'movie_url'            => 'required|max:500',
                            'categories'           => 'required|not_in:0',
                            'tags'                 => 'required|not_in:0',
                            'title'                => 'required|max:150',
                            'time'                 => 'required|max:5',
                            'views'                => 'required',
                            'description'          => 'required|max:250',
                            'embed_code'           => 'required|max:500'


        ),
        'update' => array(

                            'meta_description'     => 'required|max:200',
                            'meta_keywords'        => 'required|max:200',
                            'movie_url'            => 'required|max:500',
                            'categories'           => 'required|not_in:0',
                            'tags'                 => 'required|not_in:0',
                            'title'                => 'required|max:150',
                            'time'                 => 'required|max:5',
                            'views'                => 'required',
                            'description'          => 'required|max:250',
                            'embed_code'           => 'required|max:500'

        ),
        'movie_tag' => array(

                                        'meta_description'          => 'required|max:200',
                                        'meta_keywords'             => 'required|max:200',
                                        'tag_url'                   => 'required|max:500',
                                        'tag_name'                  => 'required|max:255'
             
        ),
        'movie_category' => array(
                                            'meta_description'              => 'required|max:200',
                                            'meta_keywords'                 => 'required|max:200',
                                            'category_url'                  => 'required|max:500',
                                            'category_name'                 => 'required|max:255'
                
        ),
        'movie_comment' => array(

                                        'name'      => 'required|max:50',
                                        'comment'   => 'required|max:500'

        )

    );


}//class Movie