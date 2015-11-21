<?php
/**
 * Author: Andrei
 * Date: 1/24/14
 * Time: 11:49 PM
 */

namespace SystemTools;

/**
 * Class Router
 *
 * Used to include routes files from functionalities (those inside CoreApp)
 */
class Router {


    /**
     * Used to include the routes file of a functionality
     *
     * @param [string] $module_name
     */
    public static function inc($module_name)
    {

        $full_path = base_path() . '/Website/CoreApp/' . $module_name . '/routes.php';

        if( file_exists( $full_path )  )
        {

            include $full_path;

        }//if the folder exists

    }//inc


}//end Router