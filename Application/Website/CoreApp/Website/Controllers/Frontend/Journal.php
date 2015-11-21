<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 8:40 PM
 */
namespace CoreApp\Website\Controllers\Frontend;

use \View, \App;

class Journal extends \Controller {


    public function index()
    {

        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');


         //journal category model
        $journal_category_model = App::make('WebsiteJournalCategoryModel'); 

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel'); 

        //Format date 
        $date_format_object = new \SystemTools\Tools;

        //Get meta
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $meta = $meta_pages_model->get_meta_by_id(3)[0];

        //Journal Posts
        $posts = $website_journal_model->get_all_posts_paginated(10);        

        $data = array(

                        'meta_description'   => $meta->meta_description,
                        'meta_keywords'      => $meta->meta_keywords,
                        'meta_title'         => $meta->page_name,
                        'posts'              => $posts,
                        'paginate_links'	 => $posts->links(),
                        'date_format'        => $date_format_object,
                        'last_5_posts'       => $website_journal_model->get_last_5_posts(),
                        'journal_categories' => $journal_category_model->all(),
                        'count_posts'        => $website_journal_model,
                        'tags'               => $journal_tag_model->all(),
                        'journal_archive'    => $website_journal_model->distinct_journal_dates(), 
                        'current_page'       => 'journal'
        );

        // print_r($data['journal_archive']);exit;

        return View::make('CoreApp/Website/Views/Frontend/journal',$data);

    }//index


    public function single_journal($journal_id,$post_url)
    {


        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');

        //Check if id exists
       if($website_journal_model->check_id_exists($journal_id) == false) return App::abort('404'); 


        //journal category model
        $journal_category_model = App::make('WebsiteJournalCategoryModel'); 

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        //Format date 
        $date_format_object = new \SystemTools\Tools;

        $journal_post = $website_journal_model->get_single_journal_by_id($journal_id)[0];


        $data = array(

                        'meta_description'   => $journal_post->meta_description,
                        'meta_keywords'      => $journal_post->meta_keywords,
                        'meta_title'         => $journal_post->title,
                        'journal_post'       => $journal_post,
                        'journal_categories' => $journal_category_model->all(),
                        'last_5_posts'       => $website_journal_model->get_last_5_posts(),
                        'date_format'        => $date_format_object,
                        'count_posts'        => $website_journal_model,
                        'tags'               => $journal_tag_model->all(),
                        'journal_archive'    => $website_journal_model->distinct_journal_dates(), 
                        'current_page'       => 'journal'
        );

        return View::make('CoreApp/Website/Views/Frontend/single_journal',$data);

    }//single_journal


    public function journals_by_category_id($category_id,$category_url)
    {
        //journal category model
        $website_category_journal_model = App::make('WebsiteJournalCategoryModel');

        //Check if id exists
       if($website_category_journal_model->check_id_exists($category_id) == false) return App::abort('404'); 

        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        $category_posts = $website_journal_model->get_posts_by_category_id($category_id,10);

        //Category header image extension
        $category_header_image_extension = $website_category_journal_model->get_category_by_id($category_id);

        //Format date 
        $date_format_object = new \SystemTools\Tools;

        //Category meta
        $category_meta = $website_category_journal_model->get_category_by_id($category_id)[0];

        $data = array(

                        'category_id'                     => $category_id,
                        'category_header_image_extension' => $category_header_image_extension[0],
                        'category_posts'                  => $category_posts,
                        'meta_description'                => $category_meta->meta_description,
                        'meta_keywords'                   => $category_meta->meta_keywords,
                        'meta_title'                      => $category_meta->name,
                        'paginate_links'                  => $category_posts->links(),
                        'date_format'                     => $date_format_object,
                        'last_5_posts'                    => $website_journal_model->get_last_5_posts(),
                        'category_name'                   => $website_category_journal_model->category_name_by_id($category_id),
                        'journal_categories'              => $website_category_journal_model->all(),
                        'count_posts'                     => $website_journal_model,
                        'tags'                            => $journal_tag_model->all(),
                        'journal_archive'                 => $website_journal_model->distinct_journal_dates(), 
                        'current_page'                    => 'journal'
        );

        return View::make('CoreApp/Website/Views/Frontend/journal_category',$data);

    }//journals_by_category_id

    public function journals_by_tag_id($tag_id,$tag_url)
    {

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        //Check if id exists
       if($journal_tag_model->check_id_exists($tag_id) == false) return App::abort('404'); 

        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');

        //journal category model
        $website_category_journal_model = App::make('WebsiteJournalCategoryModel');  


        //Tag header image extension
        $tag_header_image_extension = $journal_tag_model->get_tag_by_id($tag_id);


        $tag_posts = $website_journal_model->get_posts_by_tag_id($tag_id,10);

        // print_r($tag_posts);exit;

        //Format date 
        $date_format_object = new \SystemTools\Tools;

         //Get Tag meta
        $tag_meta = $journal_tag_model->get_tag_by_id($tag_id)[0];

        $data = array(

                        'tag_id'                     => $tag_id,
                        'tag_header_image_extension' => $tag_header_image_extension[0],
                        'tag_posts'                  => $tag_posts,
                        'meta_description'           => $tag_meta->meta_description,
                        'meta_keywords'              => $tag_meta->meta_keywords,
                        'meta_title'                 => $tag_meta->name,
                        'paginate_links'             => $tag_posts->links(),
                        'date_format'                => $date_format_object,
                        'last_5_posts'               => $website_journal_model->get_last_5_posts(),
                        'journal_categories'         => $website_category_journal_model->all(),
                        'count_posts'                => $website_journal_model,
                        'tags'                       => $journal_tag_model->all(),
                        'journal_archive'            => $website_journal_model->distinct_journal_dates(), 
                        'current_page'               => 'journal'
        );

        return View::make('CoreApp/Website/Views/Frontend/journal_tag',$data);

    }//journals_by_tag_id


    public function archived_journals($month,$year)
    {
        //journal category model
        $website_category_journal_model = App::make('WebsiteJournalCategoryModel');


        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');

        //journal tag model
        $journal_tag_model = App::make('WebsiteJournalTagModel');

        $archive_posts = $website_journal_model->get_posts_by_date($month,$year,10);

        //Format date 
        $date_format_object = new \SystemTools\Tools;

         //Get meta
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $meta = $meta_pages_model->get_meta_by_id(3)[0];

        $data = array(

                        'archive_posts'         => $archive_posts,
                        'meta_description'      => $meta->meta_description,
                        'meta_keywords'         => $meta->meta_keywords,
                        'meta_title'            => $meta->page_name,
                        'paginate_links'        => $archive_posts->links(),
                        'date_format'           => $date_format_object,
                        'last_5_posts'          => $website_journal_model->get_last_5_posts(),
                        'journal_categories'    => $website_category_journal_model->all(),
                        'count_posts'           => $website_journal_model,
                        'tags'                  => $journal_tag_model->all(),
                        'journal_archive'       => $website_journal_model->distinct_journal_dates(), 
                        'month'                 => $month,
                        'year'                  => $year,  
                        'current_page'          => 'journal'
        );

        return View::make('CoreApp/Website/Views/Frontend/journal_archive',$data);

    }//journals_by_category_id


    public function journal_search()
    {

         //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');

        //Search
        $search = \Input::get('search');

        $search_result = $website_journal_model->journal_search($search, 10);

         //Get meta
        $meta_pages_model = App::make('WebsiteMetaPagesModel');

        $meta = $meta_pages_model->get_meta_by_id(3)[0];


        $data = array(
                        'meta_description'  => $meta->meta_description,
                        'meta_keywords'     => $meta->meta_keywords,
                        'meta_title'        => $meta->page_name,
                        'search'            => $search_result,
                        'search_name'       => $search,
                        'paginate_links'    => $search_result->appends(array('search' => $search))->links(),
                        'current_page'      => 'journal'
        );

        return View::make('CoreApp/Website/Views/Frontend/journal_search',$data);

    }//journal_search

}//end Home