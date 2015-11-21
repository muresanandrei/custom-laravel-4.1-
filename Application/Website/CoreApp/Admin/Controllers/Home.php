<?php
/**
 * User: andrei
 * Date: 2/3/14
 * Time: 11:14 PM
 */

namespace CoreApp\Admin\Controllers;

use \View, \App, \Input;

class Home extends \CoreApp\Admin\BaseControllers\Admin{

    public function index()
    {



        $data = array(
            'page_title'  => trans('common.cms'),
            'breadcrumbs' => array(
                '!'                 => trans('common.cms')
            ),

        );


        return View::make('CoreApp/Admin/Views/home', $data);

    }//index


}//end Home