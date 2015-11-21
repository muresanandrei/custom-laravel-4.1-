<?php
/**
 * User: andrei
 * Date: 2/8/14
 * Time: 10:10 PM
 */
namespace CoreApp\Website\Controllers\Admin;

use \Input;

class Redactor {



    public function image_upload()
    {



        $file = Input::file('file');

        $validator = new \CoreApp\Admin\Validations\Admin(array('file' => $file), 'redactor');

        if (!$validator->passes())
        {

            return false;


        }//!Validated
        else
        {


            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $type = $_FILES['file']['tmp_name'];
            $tmp_name = $_FILES['file']['tmp_name'];

            $uploadfile = $_SERVER['DOCUMENT_ROOT'].'/dr_porn/public/cms/journal_photos/'.$name;

            move_uploaded_file($tmp_name, $uploadfile);

            return \Response::json(array('filelink' => \Request::root().'/cms/journal_photos/'.$name));

        }//Validated


    }//POST image_upload


}//end class