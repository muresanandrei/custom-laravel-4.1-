<?php
/*
 * Author Muresan Andrei
 *
 */

namespace SystemTools;

/**
 * Class Binds
 *
 * Used to include binds files from functionalities (those from CoreApp)
 */
class Binds {

    /**
     * Used to include the binds file of a functionality
     *
     * @param [string] $module_name
     */
    public static function inc($module_name)
    {

        $full_path = base_path() . '/Website/CoreApp/' . $module_name . '/binds.php';

        if( file_exists( $full_path )  )
        {

            include $full_path;

        }//if the folder exists

    }//inc

}//Binds