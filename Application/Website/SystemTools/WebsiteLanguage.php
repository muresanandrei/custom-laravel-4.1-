<?php
/**
 * User: andrei
 * Date: 1/28/14
 * Time: 10:08 PM
 */

namespace SystemTools;

/*
 * Used to handle website language
 */
class WebsiteLanguage{


    /*
     *
     * Set the website's language
     *
     */
    public static function set_language($language)
    {


        //remove the current session
        \Session::forget('site_language');


        //set the new language
        \Session::put('site_language', $language);

    }//set_language


}//end class