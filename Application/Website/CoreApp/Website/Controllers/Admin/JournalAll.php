<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 9:00 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \View, \App,\Input;

class JournalAll extends \Controller
{

	public function all()
	{


        //GET WebsitejournalModel
        $website_journal_model = App::make('WebsiteJournalModel');


        $posts = $website_journal_model->get_all_posts_paginated(1000);

		$data = array(
            'page_title'  => trans('common.journal'),
            'breadcrumbs' => array(
                'admin/home'        => trans('common.dashboard'),
                '!'    				=> trans('common.journals'),

            ),
                'posts'             => $posts,
                'paginate_links'    => $posts->links()
        );



        return View::make('CoreApp/Website/Views/Backend/Journal/all',$data);

	}//all


}//end class