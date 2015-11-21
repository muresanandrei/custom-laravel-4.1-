<?php
/**
 * User: andrei
 * Date: 1/25/14
 * Time: 12:47 AM
 */
namespace CoreApp\Authentication\Controllers;

use \View;

class Login extends \Controller {


    public function index()
    {

        return View::make('CoreApp/Authentication/Views/login');

    }//index

}//end Login