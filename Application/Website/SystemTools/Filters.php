<?php
/**
 * User: andrei
 * Date: 1/24/14
 * Time: 11:44 PM
 */
namespace SystemTools;

class Filters {

    /**
     * Used to include the filters file of a functionality
     *
     * @param [string] $module_name
     */
    public static function inc($module_name)
    {

        $full_path = base_path() . '/Website/CoreApp/' . $module_name . '/filters.php';

        if( file_exists( $full_path )  )
        {

            include $full_path;

        }//if the folder exists


    }//inc

}//Filters