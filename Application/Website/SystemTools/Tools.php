<?php
/**
 * User: andrei
 * Date: 1/24/14
 * Time: 11:51 PM
 */
namespace SystemTools;

class Tools {

    public static function format_date_time($date)
    {

        return date('d M, Y \a\t H:i', strtotime($date) );

    }//format_date_time


    public function format_date_month_only($date)
    {
    		return date('M',strtotime($date) );

    }//format_date_month_only
    

    public function format_date_day_only($date)
    {
    	return date('d',strtotime($date) );

    }//format_date_day_only


    public function format_date_month_number($date)
    {

        return date('m',strtotime($date) );

    }//format_date_month_number


    public function format_date_year_only($date)
    {

        return date('Y',strtotime($date) );

    }//format_date_year_only

    public function format_month_number($date)
    {

        return date('F',mktime(0, 0, 0, $date, 10));

    }//format_month_number

    public function format_date_time_only($date)
    {
        return date_format($date,'H:i:s');
        
    }//format date time only


    //Remove folders and files
  function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }//rrmdir

}//Tools